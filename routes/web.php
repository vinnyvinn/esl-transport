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
Route::resource('/departments', 'DepartmentController');
Route::post('/search-lead', 'LeadController@searchLeads');
Route::post('/search-dms', 'DmsController@searchDms');
Route::post('/search-customer', 'CustomerController@ajaxSearch');
Route::post('/vessel-details', 'CustomerController@vesselDetails');
Route::post('//voyage-details', 'CustomerController@voyageDetails');
Route::post('/update-vessel-details', 'CustomerController@updateVesselDetails');
Route::post('/cargo-details', 'CustomerController@cargoDetails');
Route::post('/update-cargo-details', 'CustomerController@updateCargoDetails');
Route::post('/delete-cargo', 'CustomerController@deleteCargo');
Route::post('/quotation-service', 'QuotationServiceController@addQuotationService');
Route::post('/quotation-service-delete', 'QuotationServiceController@deleteQuotationService');
Route::get('/quotation/{id}', 'QuotationController@showQuotation');
Route::get('/pdas/{status}', 'QuotationController@pdaStatus');
Route::get('/quotation/view/{id}', 'QuotationController@viewQuotation');
Route::get('/quotation/preview/{id}', 'QuotationController@previewQuotation');
Route::get('/quotation/send/{id}', 'QuotationController@sendToCustomer');
Route::get('/quotation/customer/accepted/{id}', 'QuotationController@customerAccept');
Route::get('/quotation/customer/declined/{id}', 'QuotationController@customerDecline');
Route::get('/all-notifications', 'NotificationController@index');
Route::get('/agency', 'AgencyController@index');
Route::post('/agency/approve', 'AgencyApprovalController@approve');
Route::post('/agency/disapprove', 'AgencyApprovalController@revision');
Route::get('/notifications/{id}', 'NotificationController@show');
Route::get('/quotation/request/{id}', 'QuotationController@requestQuotation');
//Route::get('/quotation/{id}/pdf', 'QuotationController@pdfQuotation');
Route::post('/update-service', 'QuotationServiceController@updateService');

//next stage
Route::get('/quotation/convert/{id}', 'QuotationController@convertCustomer');
Route::get('/bill-of-lading/{id}', 'BillOfLandingController@edit');
Route::get('/test/', 'BillOfLandingController@test');
//dms
Route::get('/dms', 'DmsController@index');
Route::get('/dms/edit/{id}', 'DmsController@edit');
Route::get('/generate/laytime/{id}', 'DmsController@generateLayTime');
Route::post('/dms/store/', 'DmsController@store');
Route::post('/dms/add/sof', 'DmsController@addSof');
Route::post('/update-dms/', 'DmsController@updateDms');
Route::post('/vessel/doc/upload/', 'VesselDocsController@upload');

//stage
Route::resource('/stages', 'StageController');
Route::resource('/stage-components', 'StageComponentController');
