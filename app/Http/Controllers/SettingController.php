<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\AppSetting;
use DB;
class SettingController extends Controller
{
    public function appSetting()
    {
    	$app=AppSetting::latest()->first();
    	return view('admin.settings.app',compact('app'));
    }

    public function appSettingSave(Request $request)
    {
    	try {
    		 DB::beginTransaction();
    		  $app=AppSetting::latest()->first();
    		  if ($app) {
    		  $save=AppSetting::find($app->id);
    		  $save->app_name=$request->app_name;
              $save->app_contact=$request->app_contact;
              $save->app_vat=$request->app_vat;
              $save->app_email=$request->app_email;
              $save->app_address=$request->app_address;
              if ($request->hasFile('app_logo')) {
                    $fileScan = $request->file('app_logo');
                    $picture = time() . rand(10000, 99999);
                    $paths = public_path() . '/logo';
                    $pathsUn = $paths.'/'.$app->app_logo;
                    @unlink($pathsUn);
                    $logo = Helper::imageUpload($fileScan, $picture, $paths);
                    } else {
                    $logo = $app->app_logo;
              } 
              $save->app_logo=$logo;
    		  $save->save();
    		  }else{
    		  $save=new AppSetting();
    		  $save->app_name=$request->app_name;
              $save->app_contact=$request->app_contact;
              $save->app_vat=$request->app_vat;
              $save->app_email=$request->app_email;
              $save->app_address=$request->app_address;
              if ($request->hasFile('app_logo')) {
                    $fileScan = $request->file('app_logo');
                    $picturea = time() . rand(10000, 99999);
                    $paths = public_path() . '/logo';
                    $logo = Helper::imageUpload($fileScan, $picturea, $paths);
                    } else {
                    $logo = null;
              } 
              $save->app_logo=$logo;
    		  $save->save();
    		}
    		  DB::commit();
    	    $request->session()->flash('success', 'Save successfully.');
            return back();
            
    		} catch (Exception $e) {
    		  DB::rollback();
             $request->session()->flash('error', 'Something wrong!');
             return back(); 
    	}
    }
}
