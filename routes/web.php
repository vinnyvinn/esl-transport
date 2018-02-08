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
Route::get('/customer-request/{customer_id}/{customer_type}', 'CustomerRequestController@customerRequest');
Route::resource('/good-types', 'GoodTypeController');
Route::resource('/leads', 'LeadController');
Route::resource('/tariffs', 'TariffController');
Route::post('/search-lead', 'LeadController@searchLeads');
Route::post('/search-customer', 'CustomerController@ajaxSearch');
Route::post('/vessel-details', 'CustomerController@vesselDetails');
Route::post('/update-vessel-details', 'CustomerController@updateVesselDetails');
Route::post('/cargo-details', 'CustomerController@cargoDetails');
Route::post('/update-cargo-details', 'CustomerController@updateCargoDetails');
Route::post('/delete-cargo', 'CustomerController@deleteCargo');
Route::post('/quotation-service', 'QuotationServiceController@addQuotationService');
Route::post('/quotation-service-delete', 'QuotationServiceController@deleteQuotationService');
Route::get('/quotation/{id}', 'QuotationController@showQuotation');
Route::post('/update-service', 'QuotationServiceController@updateService');