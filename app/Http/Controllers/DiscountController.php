<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;
use DB;
class DiscountController extends Controller
{
    public function index()
    {
    	$discounts=Discount::get();
    	return view('admin.discount.index',compact('discounts'));
    }

    public function create()
    {
    	return view('admin.discount.create');
    }

    public function edit($id)
    {
    	$data=Discount::find($id);
    	return view('admin.discount.edit',compact('data'));
    }

   public function store(Request $request)
   {
   	 try {
   	 	
    		 DB::beginTransaction();
    		  $save=new Discount();
    		  $save->code=$request->code;
    		  $save->note=$request->note;
    		  $save->percent=$request->percent;
    		  $save->end_date=$request->end_date;
    		  $save->amount=$request->amount;
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
    		  $save=Discount::find($id);
    		    $save->code=$request->code;
    		  $save->note=$request->note;
    		  $save->end_date=$request->end_date;
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

   public function destroy(Request $request)
   {
   	 try {
    		  DB::beginTransaction();
    		  $save=Discount::find($request->id);
    		  $save->delete();
    		  DB::commit();
              $request->session()->flash('success', 'Delete successfully.');
              return back();
    	    
    		} catch (Exception $e) {
    		  DB::rollback();
        	  $request->session()->flash('error', 'Something wrong!');
             return back();
    	}
   }
}
