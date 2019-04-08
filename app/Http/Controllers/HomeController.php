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
        return view('layouts.body',compact('categories'));
    }

    public function subItems($id)
    {
    	$product=Product::find($id);
    	$subItem=MenusItem::where('product_id',$id)->get();
        return view('layouts.loadSubItems',compact('subItem','product'));
    }

    public function addTocart(Request $request)
    {
        
    	$cart=Cart::add([
            'id'      => $request->pdt, 
            'name'    => $request->item.','.$request->name,
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
         
        return redirect()->route('payments.show');
    }

    public function paymentForm()
    {
        return view('layouts.payment');
    }

    public function confirmOrder(Request $request)
    {

        if ($request->payment_type==1) {
            # code...
        }else{
             Validator::make($request->all(), [
                    'card_number' => 'required',
                    'exp_date' => 'required',
                    'exp_year' => 'required',
                    'card_cvv' => 'required',
                ]);

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
                    $request->session()->flash('error', "The Stripe Token was not generated correctly");
                    return back();
                }

                $withFee = ((234 * 2.9) / 100);
                $totalCharge = 234 + $withFee;
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

                }
            }
    }

 
}
