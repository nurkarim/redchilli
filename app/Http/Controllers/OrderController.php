<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
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
    	$orders=Order::where('status',1)->get();
    	return view('admin.orders.cancelOrder',compact('orders'));
    }
}
