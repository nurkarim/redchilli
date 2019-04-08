<?php

Route::group(['prefix' => 'admin'], function() {
	 Route::get('/', function () {
	    return view('admin._partials.app');
	})->name('admin');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('foodMenus', 'FoodMenuController');
    Route::resource('orders', 'OrderController');
    Route::get('users/pending', 'OrderController@pendingOrder')->name('orders.pending');
    Route::get('users/cancel', 'OrderController@cancelOrder')->name('orders.cancel');
    Route::get('settings/app', 'SettingController@appSetting')->name('settings.app');
    Route::post('settings/app', 'SettingController@appSettingSave')->name('settings.appSave');

});
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/prodcut/{id}', 'HomeController@subItems')->name('product.subItems');
