<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\FoodMenu;
use App\MenusItem;
use App\Order;
use App\OrderCart;
use App\Notification;
class AdminController extends Controller
{
    public function index()
    {
    	$active=Order::where('status',1)->count();
    	$inactive=Order::where('status',0)->count();
    	$cancelOrder=Order::where('status',2)->count();
    	$orders=Order::where('status',0)->orderBy('id','DESC')->get();
    	$products=Product::count();
    	return view('admin._partials.app',compact('active','inactive','cancelOrder','products','orders'));
    }

    public function getNotification()
    {
    	$notifys=Notification::where('status',0)->get();
    	return view("admin.notify",compact('notifys'));
    }

    public function activeNotify()
    {
        $notifys=Notification::where('status',0)->update([
            'status'=>1
        ]);
    }
}
