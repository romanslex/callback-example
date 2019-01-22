<?php


Route::get("/home/orders/get-orders", "OrdersController@getOrders");

Route::get('/home{any}', 'SpaController@index')->where('any', '.*');

Auth::routes();
Route::get("/", "Auth\LoginController@showLoginForm")->name("login");

Route::get('/home', 'HomeController@index')->name('home');
