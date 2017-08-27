<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('shops', 'Shop\\ShopsController');
Route::resource('devices', 'Device\\DevicesController', ['except' => ['deleteImage']]);
Route::get('devices/deleteImage/{id}', 'Device\\DevicesController@deleteImage');

Route::resource('orders', 'Order\\OrdersController', ['except' => ['getDevice']]);
Route::get('orders/device/{keyword}', 'Order\\OrdersController@getDevice');
Route::get('orders/invoice/{id}', 'Order\\OrdersController@invoice');
Route::post('orders/download/{id}', 'Order\\OrdersController@download');
Route::resource('users', 'User\\UsersController');

Route::get('users/{user}/shops', 'User\\UsersController@shops')->name('users.shops');
Route::post('users/{user}/shops/{shop}', 'User\\UsersController@alterShop');
