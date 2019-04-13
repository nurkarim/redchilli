<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\AppSetting;
use DB;
use Stripe\Stripe;
class OrderController extends Controller
{
    public function index()
    {
    	$orders=Order::where('status',1)->get();
    	return view('admin.orders.index',compact('orders'));
    }

    public function pendingOrder()
    {
    	$orders=Order::where('status',0)->get();
    	return view('admin.orders.pendingOrder',compact('orders'));
    } 

    public function cancelOrder()
    {
    	$orders=Order::where('status',2)->get();
    	return view('admin.orders.cancelOrder',compact('orders'));
    }

    public function show($id)
    {
        $order=Order::find($id);
        return view("admin.orders.show",compact('order'));
    } 
    public function edit($id)
    {
        $order=Order::find($id);
        return view("admin.orders.edit",compact('order'));
    }
    public function printPaper($id)
    {
        $order=Order::find($id);
        $app=AppSetting::latest()->first();
        return view("admin.orders.print",compact('order','app'));
    }

    public function update($id,Request $request)
    {
        try {
             DB::beginTransaction();
                if ($request->status==1) {
                  $order=Order::find($id);  
                  $order->status=1;
                  $order->save();
                $request->session()->flash('success', 'Order approved successfully.');
                }else{

                  $order=Order::find($id);  
                  $order->status=2;
                  $order->save();
                  if ($order->pay_type==2) {
                  
                   Stripe::setApiKey(env('STRIPE_KEY'));
                   $val = round($order->total * 100);
                    $refund = \Stripe\Refund::create([
                        'charge' => $order->stripe_charge_id,
                    ]);

                  }
                    $request->session()->flash('success', 'Order cancel successfully.');
                }
             DB::commit();
            
            return back();
            
            } catch (Exception $e) {
                return $e;
              DB::rollback();
             $request->session()->flash('error', 'Something wrong!');
             return back(); 
        }
    }
}
