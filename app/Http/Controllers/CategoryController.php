<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
class CategoryController extends Controller
{
    public function index()
    {
    	$categories=Category::get();
    	return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
    
    	return view('admin.category.create');
    }

    public function edit($id)
    {
    	$data=Category::find($id);
    	return view('admin.category.edit',compact('data'));
    }

   public function store(Request $request)
   {
   	 try {
    		 DB::beginTransaction();
    		  $save=new Category();
    		  $save->name=$request->name;
              $save->note=$request->note;
    		  $save->status=1;
    		  $save->save();
    		  DB::commit();
    	    $request->session()->flash('success', 'Category create successfully.');
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
    		  $save=Category::find($id);
    		  $save->name=$request->name;
              $save->note=$request->note;
    		  $save->save();
    		  DB::commit();
            $request->session()->flash('success', 'Category updated successfully.');
            return back();
    	    
    		} catch (Exception $e) {
    		  DB::rollback();
        	  $request->session()->flash('error', 'Something wrong!');
             return back();
    	}
   }
}
