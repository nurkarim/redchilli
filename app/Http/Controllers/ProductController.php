<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\FoodMenu;
use App\MenusItem;
use DB;
class ProductController extends Controller
{
    public function index()
    {
    	$products=Product::get();
    	return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $categories=Category::get();
        $foodMenus=FoodMenu::get();
    	return view('admin.products.create',compact('categories','foodMenus'));
    }

    public function edit($id)
    {
    	$data=Product::find($id);
        $categories=Category::get();
        $foodMenus=FoodMenu::get();
    	return view('admin.products.edit',compact('data','categories','foodMenus'));
    }

   public function store(Request $request)
   {
   	 try {
    		 DB::beginTransaction();
    		  $save=new Product();
    		  $save->category_id=$request->category_id;
              $save->food_menus_id=$request->food_menus_id;
    		  $save->name=$request->name;
    		  $save->price=$request->price;
              $save->details=$request->details;
    		  $save->save();
              if ($save) {
                  
                  if ($request->has('items')) {
                      
                      for ($i=0; $i < sizeof($request->items) ; $i++) { 
                         
                         MenusItem::create([
                            'product_id'=>$save->id,
                            'name'=>$request->items[$i],
                         ]);

                      }
                  }
              }
    		  DB::commit();
    	    $request->session()->flash('success', 'Product create successfully.');
            return back();
            
    		} catch (Exception $e) {
    		  DB::rollback();
             $request->session()->flash('error', 'Something wrong!');
             return back(); 
    	}
   }

   public function update($id,Request $request)
   {
   	 try {
             DB::beginTransaction();
              $save=Product::find($id);
              $save->category_id=$request->category_id;
              $save->food_menus_id=$request->food_menus_id;
              $save->name=$request->name;
              $save->price=$request->price;
              $save->details=$request->details;
              $save->save();
              if ($save) {
                  
                  if ($request->has('items')) {
                      MenusItem::where('product_id',$id)->delete();
                      for ($i=0; $i < sizeof($request->items) ; $i++) { 
                         MenusItem::create([
                            'product_id'=>$id,
                            'name'=>$request->items[$i],
                         ]);
                      }
                  }
              }
              DB::commit();
             $request->session()->flash('success', 'Product update successfully.');
             return back();
            } catch (Exception $e) {
              DB::rollback();
             $request->session()->flash('error', 'Something wrong!');
             return back(); 
        }
   }

   public function delete(Request $request)
    {
      try {
            DB::beginTransaction();
            $save=Product::find($request->id);
            $save->delete();
            DB::commit();
            $request->session()->flash('success', "Delete successfully");
            return back();
            } catch (Exception $e) {
            DB::rollback();
            $request->session()->flash('error', 'Something wrong!');
            return back(); 
        }
    }
}
