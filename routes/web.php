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

Auth::routes();

Route::get('/', 'HomeController@dashboard');
Route::resource('/customers', 'CustomerController');
Route::get('/customer-request', 'CustomerController@customerRequest');
Route::resource('/good-types', 'GoodTypeController');
Route::post('/search-customer', 'CustomerController@ajaxSearch');