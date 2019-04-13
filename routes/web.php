<?php

Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {
	 Route::get('/', 'AdminController@index')->name('admin');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('foodMenus', 'FoodMenuController');
    Route::resource('orders', 'OrderController');
    Route::get('orders/print/{id}', 'OrderController@printPaper')->name('orders.print');
    Route::resource('discounts', 'DiscountController');
    Route::post('discounts/delete', 'DiscountController@destroy')->name('discounts.destroy');
    Route::get('users/pending', 'OrderController@pendingOrder')->name('orders.pending');
    Route::get('users/cancel', 'OrderController@cancelOrder')->name('orders.cancel');
    Route::get('settings/app', 'SettingController@appSetting')->name('settings.app');
    Route::post('settings/app', 'SettingController@appSettingSave')->name('settings.appSave');

    Route::get('sync-data', 'AdminController@getNotification')->name('sync-data');
    Route::get('activeNotify', 'AdminController@activeNotify')->name('activeNotify');

});
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/prodcut/{id}', 'HomeController@subItems')->name('product.subItems');
Route::get('ajaxAddCart', 'HomeController@addTocart')->name('ajaxAddCart');
Route::get('ajaxCartdelete', 'HomeController@ajaxCartdelete')->name('ajaxCartdelete');
Route::get('checkouts', 'HomeController@checkout')->name('checkouts.show');
Route::post('checkouts', 'HomeController@storeCheckout')->name('checkouts.store');
Route::get('payments', 'HomeController@paymentForm')->name('payments.show');
Route::post('payments', 'HomeController@confirmOrder')->name('payments.save');
