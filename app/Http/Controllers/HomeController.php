<?php

namespace App\Http\Controllers;

use App\Category;
use App\Discount;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderNotification;
use App\MenusItem;
use App\Notification;
use App\Order;
use App\OrderCart;
use App\Product;
use Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Session;
use Stripe\Stripe;
use Toastr;
use Stripe\Error\Card;
class HomeController extends Controller
{

    public function index(Request $request)
    {
        //  $request->session()->forget('cart');
        // return $request->session()->get('cart');
        $categories = Category::get();
        $discount = Discount::where('end_date', '>=', date('Y-m-d'))->latest()->first();
        return view('layouts.body', compact('categories', 'discount'));
    }

    public function subItems($id)
    {
        $product = Product::find($id);
        $subItem = MenusItem::where('product_id', $id)->get();
        return view('layouts.loadSubItems', compact('subItem', 'product'));
    }

    public function addTocart(Request $request)
    {
        if (empty($request->item)) {
            $name = $request->name;
        } else {
            $name = $request->item . ',' . $request->name;
        }
        $cart = Cart::add([
            'id' => $request->pdt,
            'name' => $name,
            'qty' => $request->qty,
            'price' => $request->price,
            'options' => ['subItem' => $request->subitem],
        ]);
        if ($cart) {
            return response()->json([
                'status' => true,
                'sms' => 'Item successfully added',
            ]);
        }
        return response()->json([
            'status' => false,
            'sms' => 'Item added unsuccessfully',
        ]);

    }

    public function ajaxCartdelete(Request $request)
    {

        // CartItem->generateRowId() must be change md5 to default
        $cart = Cart::remove($request->pdt);
        return response()->json([
            'status' => true,
            'sms' => 'Item delete successfully ',
        ]);

    }

    public function checkout(Request $request)
    {
        $subtotal = 0;
        foreach (Cart::content() as $row) {
            $subtotal += $row->price;
        }
        if ($subtotal < 10) {
            Toastr::error('Place order must be above £10.00', 'Error', ["positionClass" => "toast-top-right"]);

            return redirect('/');
        }
        return view('layouts.checkout');
    }

    public function storeCheckout(CheckoutRequest $request)
    {
        $discount = 0;
        $subtotal = 0;
        foreach (Cart::content() as $row) {
            $subtotal += $row->price;
        }

        Session::put('full_name', $request->full_name);
        Session::put('email', $request->email);
        Session::put('phone', $request->phone);
        Session::put('delivery_address', $request->delivery_address);
        Session::put('delivery_times', $request->delivery_times);
        Session::put('notes', $request->notes);
        Session::put('coupon_code', $request->coupon_code);

        if (!empty($request->coupon_code)) {
            $getDisCode = Discount::where('code', $request->coupon_code)->first();
            if ($getDisCode) {

                if (date('Y-m-d') <= $getDisCode->end_date) {
                    if ($getDisCode->amount <= $subtotal) {
                        $discount = (($subtotal * $getDisCode->percent) / 100);
                        Session::put('discount', $discount);

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
            if (Cart::count() == 0) {
                Toastr::error('Sorry!Items not found.', 'Empty Cart', ["positionClass" => "toast-top-right"]);
                return redirect('/');
            }
            $subtotal = 0;
            foreach (Cart::content() as $row) {
                $subtotal += $row->price;
            }

            $discount = 0;
            if (!empty(Session::get('coupon_code'))) {
                $getDisCode = Discount::where('code', Session::get('coupon_code'))->first();
                if ($getDisCode) {

                    if (date('Y-m-d') <= $getDisCode->end_date) {
                        if ($getDisCode->amount <= $subtotal) {
                            $discount = (($subtotal * $getDisCode->percent) / 100);
                        }
                    }

                }
            }

            $subtotalWithDis = $subtotal - $discount;
            $grandTotal = $request->charge + $subtotalWithDis;
            $stripFee = 2.9;

            if ($request->payment_type == 1) {
                $order = Order::create([
                    'date' => date('Y-m-d'),
                    'customer_name' => Session::get('full_name'),
                    'email' => Session::get('email'),
                    'contact' => Session::get('phone'),
                    'delivery_times' => Session::get('delivery_times'),
                    'delivery_address' => Session::get('delivery_address'),
                    'note' => Session::get('notes'),
                    'discount_code' => Session::get('coupon_code'),
                    'total_product' => Cart::count(),
                    'sub_total' => $subtotal,
                    'tax' => $request->charge,
                    'discount' => $discount,
                    'stripe_fee' => 0,
                    'total' => $grandTotal,
                    'pay_type' => $request->payment_type,
                ]);
                if ($order) {
                    foreach (Cart::content() as $row) {
                        OrderCart::create([
                            'order_id' => $order->id,
                            'product_id' => $row->id,
                            'name' => $row->name,
                            'price' => $row->price,
                            'qty' => $row->qty,
                            'sub_items' => $row->options->subItem,
                            'total' => $row->price,
                        ]);
                    }
                    Cart::destroy();

                    Notification::create([
                        'title' => "New order",
                        'order_id' => $order->id,
                        'customer' => Session::get('full_name'),
                        'note' => "New order submited.Order amount " . $grandTotal . " Order No ORD-" . $order->id,
                        'status' => 0,
                    ]);

                    Session::put('coupon_code', null);
                    Session::put('discount', null);
                    if ($order->tax == 0) {
                        $type = "Collection";
                    } else {
                        $type = "Delivery";
                    }
                    $data = [
                        'id' => $order->id,
                        'name' => $order->customer_name,
                        'email' => $order->email,
                        'phone' => $order->contact,
                        'delivery' => $order->delivery_address,
                        'deliveryTimes' => $order->delivery_times,
                        'subtotal' => $order->sub_total,
                        'discount' => $order->discount,
                        'fee' => $order->tax,
                        'grand_total' => $order->total,
                        'carts' => $order->carts,
                        'type' => $type,
                    ];
                    Mail::to($order->email)->send(new OrderNotification($data));
                    DB::commit();

                    return view('layouts.success', compact('order'));
                }

            } else {

                if (empty($request->card_number) || empty($request->exp_date) || empty($request->exp_year) || empty($request->card_cvv)) {
                    Toastr::error('Fill up card form', 'Error', ["positionClass" => "toast-top-right"]);
                    return back();
                }

                try {
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

                    $order = Order::create([
                        'date' => date('Y-m-d'),
                        'customer_name' => Session::get('full_name'),
                        'email' => Session::get('email'),
                        'contact' => Session::get('phone'),
                        'delivery_times' => Session::get('delivery_times'),
                        'delivery_address' => Session::get('delivery_address'),
                        'stripe_balance_transaction_id' => $charge['balance_transaction'],
                        'stripe_charge_id' => $charge->id,
                        'stripe_details' => $charge['source'],
                        'srtip_billing_details' => $charge['billing_details'],
                        'stripe_card' => $request->card_number,
                        'note' => Session::get('notes'),
                        'discount_code' => Session::get('coupon_code'),
                        'total_product' => Cart::count(),
                        'sub_total' => $subtotal,
                        'tax' => $request->charge,
                        'discount' => $discount,
                        'stripe_fee' => $withFee,
                        'total' => $grandTotal,
                        'pay_type' => $request->payment_type,
                    ]);
                    if ($order) {
                        foreach (Cart::content() as $row) {
                            OrderCart::create([
                                'order_id' => $order->id,
                                'product_id' => $row->id,
                                'name' => $row->name,
                                'price' => $row->price,
                                'qty' => $row->qty,
                                'sub_items' => $row->options->subItem,
                                'total' => $row->price,
                            ]);
                        }
                        Cart::destroy();

                        Notification::create([
                            'title' => "New order",
                            'order_id' => $order->id,
                            'customer' => Session::get('full_name'),
                            'note' => "New order submited.Order amount " . $grandTotal . " Order No ORD-" . $order->id,
                            'status' => 0,
                        ]);
                    }

                    Session::put('coupon_code', null);
                    Session::put('discount', null);

                    if ($order->tax == 0) {
                        $type = "Collection";
                    } else {
                        $type = "Delivery";
                    }
                    $data = [
                        'id' => $order->id,
                        'name' => $order->customer_name,
                        'email' => $order->email,
                        'phone' => $order->contact,
                        'delivery' => $order->delivery_address,
                        'deliveryTimes' => $order->delivery_times,
                        'subtotal' => $order->sub_total,
                        'discount' => $order->discount,
                        'fee' => $order->tax,
                        'grand_total' => $order->total,
                        'carts' => $order->carts,
                        'type' => $type,
                    ];
                    Mail::to($order->email)->send(new OrderNotification($data));

                    DB::commit();

                    return view('layouts.success', compact('order'));
                }else{
                     Toastr::error("Something was wrong", 'Error', ["positionClass" => "toast-top-right"]);
                  return back();
                }
                } catch(\Stripe\Error\Card $e) {
                  // Since it's a decline, \Stripe\Error\Card will be caught
                  $body = $e->getJsonBody();
                  // $err  = $body['error'];$err['message']
                Toastr::error($e->getMessage(), 'Card Error', ["positionClass" => "toast-top-right"]);
                    return back();
                  
                } catch (\Stripe\Error\RateLimit $e) {
                  Toastr::error("Something was wrong", 'Error', ["positionClass" => "toast-top-right"]);
                  return back();
                } catch (\Stripe\Error\InvalidRequest $e) {
                  Toastr::error("Something was wrong", 'Error', ["positionClass" => "toast-top-right"]);
                   return back();
                } catch (\Stripe\Error\Authentication $e) {
                  Toastr::error("Something was wrong", 'Error', ["positionClass" => "toast-top-right"]);
                  return back();
                } catch (\Stripe\Error\ApiConnection $e) {
                  Toastr::error("Something was wrong", 'Error', ["positionClass" => "toast-top-right"]);
                   return back();
                } catch (\Stripe\Error\Base $e) {
                  Toastr::error($e->getMessage(), 'Error', ["positionClass" => "toast-top-right"]);
                  return back();
                } catch (Exception $e) {
                  Toastr::error($e->getMessage(), 'Error', ["positionClass" => "toast-top-right"]);
                 return back();
                }

            

            }

            Toastr::error('Something was wrong.', 'Order Error', ["positionClass" => "toast-top-right"]);
            return back();
        } catch (Exception $e) {
            DB::rollback();
            Toastr::error($e->getMessage(), 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

}
