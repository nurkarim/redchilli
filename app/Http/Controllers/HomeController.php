<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Category;
use App\Product;
use App\FoodMenu;
use App\MenusItem;
use App\Order;
use App\OrderCart;
use App\Discount;
use App\Notification;
use DB;
use Cart;
use Toastr;
use Session;
use Carbon\Carbon;
use Stripe\Stripe;
class HomeController extends Controller
{
    
    public function index(Request $request)
    {
         //  $request->session()->forget('cart');
         // return $request->session()->get('cart');
        $categories=Category::get();
        $discount=Discount::where('end_date','>=',date('Y-m-d'))->latest()->first();
        return view('layouts.body',compact('categories','discount'));
    }

    public function subItems($id)
    {
    	$product=Product::find($id);
    	$subItem=MenusItem::where('product_id',$id)->get();
        return view('layouts.loadSubItems',compact('subItem','product'));
    }

    public function addTocart(Request $request)
    {
        if (empty($request->item)) {
           $name=$request->name;
        }else{
            $name=$request->item.','.$request->name;
        }
    	$cart=Cart::add([
            'id'      => $request->pdt, 
            'name'    => $name,
            'qty'      => $request->qty, 
            'price'   => $request->price, 
            'options' => ['subItem'=>$request->subitem], 
            ]);
        if ($cart) {
           return response()->json([
            'status'=>true,
            'sms'=>'Item successfully added'
            ]);
        }
       return response()->json([
            'status'=>false,
            'sms'=>'Item added unsuccessfully'
            ]);

           
    }

   

    public function ajaxCartdelete(Request $request)
    {

        // CartItem->generateRowId() must be change md5 to default
    	  $cart=Cart::remove($request->pdt);
           return response()->json([
            'status'=>true,
            'sms'=>'Item delete successfully '
            ]);
        
       
    }

    public function checkout()
    {
        return view('layouts.checkout');
    }

    public function storeCheckout(CheckoutRequest $request)
    {
        
        Session::put('full_name',$request->full_name);
        Session::put('email',$request->email);
        Session::put('phone',$request->phone);
        Session::put('delivery_address',$request->delivery_address);
        Session::put('delivery_times',$request->delivery_times);
        Session::put('notes',$request->notes);
        Session::put('coupon_code',$request->coupon_code);
          $discount=0;
           $subtotal=0;
        foreach(Cart::content() as $row) {
            $subtotal+=$row->price;
        }
        if (!empty($request->coupon_code)) {
            $getDisCode=Discount::where('code',$request->coupon_code)->first();
            if ($getDisCode) {

            if (date('Y-m-d') <= $getDisCode->end_date) {
                if ($getDisCode->amount <= $subtotal) {
                    $discount=(($subtotal*$getDisCode->percent)/100);
                   Session::put('discount',$discount);

                }
            }

            }
        }
        return redirect()->route('payments.show');
    }

    public function paymentForm()
    {
        return view('layouts.payment');
    }

    public function confirmOrder(Request $request)
    {

        try {
             DB::beginTransaction();
             Validator::make($request->all(), [
                    'payment_type' => 'required|numeric',
            ]);
        if (Cart::count() < 0) {
           return $request->session()->flash('error', 'Sorry!Items not found.');
        }
        $subtotal=0;
        foreach(Cart::content() as $row) {
            $subtotal+=$row->price;
        }


        $discount=0;
        if (!empty(Session::get('coupon_code'))) {
            $getDisCode=Discount::where('code',Session::get('coupon_code'))->first();
            if ($getDisCode) {

            if (date('Y-m-d') <= $getDisCode->end_date) {
                if ($getDisCode->amount <= $subtotal) {
                    $discount=(($subtotal*$getDisCode->percent)/100);
                }
            }

            }
        }
            

      
        $subtotalWithDis=$subtotal-$discount;
        $grandTotal=2+$subtotalWithDis;
        $stripFee=2.9;

        if ($request->payment_type==1) {
            $order=Order::create([
                        'date'=>date('Y-m-d'),
                        'customer_name'=>Session::get('full_name'),
                        'email'=>Session::get('email'),
                        'contact'=>Session::get('phone'),
                        'delivery_times'=>Session::get('delivery_times'),
                        'delivery_address'=>Session::get('delivery_address'),
                        'note'=>Session::get('notes'),
                        'discount_code'=>Session::get('coupon_code'),
                        'total_product'=>Cart::count(),
                        'sub_total'=>$subtotal,
                        'tax'=>2,
                        'discount'=>$discount,
                        'stripe_fee'=>0,
                        'total'=>$grandTotal,
                        'pay_type'=>$request->payment_type,
        ]);
            if ($order) {
                  foreach(Cart::content() as $row) {
                        OrderCart::create([
                            'order_id'=>$order->id,
                            'product_id'=>$row->id,
                            'name'=>$row->name,
                            'price'=>$row->price,
                            'qty'=>$row->qty,
                            'sub_items'=>$row->options->subItem,
                            'total'=>$row->price,
                        ]);
                     }
                Cart::destroy();

                Notification::create([
                    'title'=>"New order",
                    'order_id'=>$order->id,
                    'customer'=>Session::get('full_name'),
                    'note'=>"New order submited.Order amount ".$grandTotal." Order No ORD-".$order->id,
                    'status'=>0,
                ]);
            }

        }else{

                if (empty($request->card_number)||empty($request->exp_date)||empty($request->exp_year)||empty($request->card_cvv)) {
                     Toastr::error('Fill up card form', 'Error', ["positionClass" => "toast-top-right"]);
                     return back();
                }

                \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
                //$stripe = Stripe::make(env('STRIPE_KEY'));
                $token = \Stripe\Token::create([
                    'card' => [
                        'number' => $request->card_number,
                        'exp_month' => $request->exp_date,
                        'exp_year' => $request->exp_year,
                        'cvc' => $request->card_cvv,
                    ],
                ]);

                if (!isset($token['id'])) {
                Toastr::error('The Stripe Token was not generated correctly', 'Error', ["positionClass" => "toast-top-right"]);
                    return back();
                }

                $withFee = (($grandTotal * $stripFee) / 100);
                $totalCharge = $grandTotal + $withFee;
                $val = round($totalCharge * 100);
                $total = intval($val);
                $token = $token['id'];
                $charge = \Stripe\Charge::create([
                        'amount' => $val,
                        'currency' => 'GBP',
                        'description' => 'New Order charge',
                        'source' => $token,
                    ]);
             
                if ($charge['status'] == 'succeeded') {

                    $order=Order::create([
                        'date'=>date('Y-m-d'),
                        'customer_name'=>Session::get('full_name'),
                        'email'=>Session::get('email'),
                        'contact'=>Session::get('phone'),
                        'delivery_times'=>Session::get('delivery_times'),
                        'delivery_address'=>Session::get('delivery_address'),
                        'stripe_balance_transaction_id'=>$charge['balance_transaction'],
                        'stripe_charge_id'=>$charge->id,
                        'stripe_details'=>$charge['source'],
                        'srtip_billing_details'=>$charge['billing_details'],
                        'stripe_card'=>$request->card_number,
                        'note'=>Session::get('notes'),
                        'discount_code'=>Session::get('coupon_code'),
                        'total_product'=>Cart::count(),
                        'sub_total'=>$subtotal,
                        'tax'=>2,
                        'discount'=>$discount,
                        'stripe_fee'=>$withFee,
                        'total'=>$grandTotal,
                        'pay_type'=>$request->payment_type,
                    ]);
                    if ($order) {
                        foreach(Cart::content() as $row) {
                        OrderCart::create([
                            'order_id'=>$order->id,
                            'product_id'=>$row->id,
                            'name'=>$row->name,
                            'price'=>$row->price,
                            'qty'=>$row->qty,
                            'sub_items'=>$row->options->subItem,
                            'total'=>$row->price,
                        ]);
                     }
                      Cart::destroy();

                       Notification::create([
                    'title'=>"New order",
                    'order_id'=>$order->id,
                    'customer'=>Session::get('full_name'),
                    'note'=>"New order submited.Order amount ".$grandTotal." Order No ORD-".$order->id,
                    'status'=>0,
                ]);
                    }
                }
            }
            Session::put('coupon_code'," ");
            Session::put('discount'," ");
            DB::commit();
            Toastr::success('New Order Successfully', 'Order Success', ["positionClass" => "toast-top-right"]);
            return redirect('/');
            
            } catch (Exception $e) {
              DB::rollback();
             Toastr::error($e->getMessage(), 'Error', ["positionClass" => "toast-top-right"]);
             return back(); 
        }
    }

 
}
