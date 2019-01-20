<?php

Route::get("/", "Auth\LoginController@showLoginForm");

Route::get("/home/orders/get-orders", "OrdersController@getOrders");

Route::get('/home{any}', 'SpaController@index')->where('any', '.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
