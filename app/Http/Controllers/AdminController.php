<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\FoodMenu;
use App\MenusItem;
use App\Order;
use App\OrderCart;
class AdminController extends Controller
{
    public function index()
    {
    	$active=Order::where('status',1)->count();
    	$inactive=Order::where('status',0)->count();
    	$cancelOrder=Order::where('status',2)->count();
    	$orders=Order::where('status',0)->get();
    	$products=Product::count();
    	return view('admin._partials.app',compact('active','inactive','cancelOrder','products','orders'));
    }
}
