<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\FoodMenu;
use App\MenusItem;
use DB;
use Cart;
class HomeController extends Controller
{
    
    public function index()
    {
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
    	Cart::add(['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'options' => ['size' => 'large']]);
    }

    public function cartQtyUpdate(Request $request)
    {
    	Cart::update($rowId, 2); // Will update the quantity
    	Cart::update($rowId, ['name' => 'Product 1']); // Will update the name
    }

    public function cartRemove($rowId)
    {
    	Cart::remove($rowId);
    }

    public function cartTex($value='')
    {
    	Cart::tax(2, '.', ',');
    }
}
