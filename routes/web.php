<?php


Route::get("/data/orders/get-orders", "Data\OrdersController@getOrders");
Route::get("/data/widgets", "Data\WidgetsController@getWidgets");
Route::get("/data/widgets/{id}", "Data\WidgetsController@getWidgetById");
Route::put("/data/widgets/{id}", "Data\WidgetsController@update");
Route::post("/data/widgets", "Data\WidgetsController@store");
Route::delete("/data/widgets/{id}", "Data\WidgetsController@destroy");
Route::post("/data/widgets/send-manual/{id}", "Data\WidgetsController@sendManual");

Route::get("/data/payments", "Data\PaymentsController@index");

Route::post("/data/black-ip", "Data\AntispamController@storeIp");
Route::delete("/data/black-ip/{id}", "Data\AntispamController@deleteIp");
Route::get("/data/antispam", "Data\AntispamController@index");
Route::post("/data/black-phones", "Data\AntispamController@storePhone");
Route::delete("/data/black-phones/{id}", "Data\AntispamController@deletePhone");

Route::post("/data/feedback/send-comment", "Data\FeedbackController@sendComment");

Route::get("home/window-appearance/{id}", "WindowAppearanceController@index");
Route::put("home/window-appearance/{id}", "WindowAppearanceController@update");

Route::get("home/btn-appearance/{id}", "BtnAppearanceController@index");
Route::put("home/btn-appearance/{id}", "BtnAppearanceController@update");

Route::get('/home{any}', 'SpaController@index')->where('any', '.*');

Auth::routes();
Route::get("/", "Auth\LoginController@showLoginForm")->name("login");

Route::get('/home', 'HomeController@index')->name('home');
