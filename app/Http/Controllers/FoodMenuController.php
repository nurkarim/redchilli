<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodMenu;
use DB;
class FoodMenuController extends Controller
{
    public function index()
    {
    	$categories=FoodMenu::get();
    	return view('admin.foodMenus.index',compact('categories'));
    }

    public function create()
    {
    	return view('admin.foodMenus.create');
    }

    public function edit($id)
    {
    	$data=FoodMenu::find($id);
    	return view('admin.foodMenus.edit',compact('data'));
    }

   public function store(Request $request)
   {
   	 try {
    		 DB::beginTransaction();
    		  $save=new FoodMenu();
    		  $save->name=$request->name;
              $save->note=$request->note;
    		  $save->save();
    		  DB::commit();
    	    $request->session()->flash('success', 'Add successfully.');
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
    		  $save=FoodMenu::find($id);
    		  $save->name=$request->name;
              $save->note=$request->note;
    		  $save->save();
    		  DB::commit();
            $request->session()->flash('success', 'Update successfully.');
            return back();
    	    
    		} catch (Exception $e) {
    		  DB::rollback();
        	  $request->session()->flash('error', 'Something wrong!');
             return back();
    	}
   }
}
