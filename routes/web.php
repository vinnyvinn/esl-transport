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
Route::post('/others-vessel-details', 'CustomerController@oVesselDetails');
Route::post('/voyage-details/{id}', 'CustomerController@voyageDetails')->name('add-quotation-voyage');
Route::post('/consignee-details/{id}', 'CustomerController@consigneeDetails')->name('add-quotation-consignee');
Route::post('/update-vessel-details', 'CustomerController@updateVesselDetails');
Route::post('/cargo-details/{id}', 'CustomerController@cargoDetails')->name('add_cargo-to-quotation');
Route::post('/update-cargo-details/{id}', 'CustomerController@updateCargoDetails')->name('update-quotation-cargo-details');
Route::post('/delete-cargo/{id}', 'CustomerController@deleteCargo')->name('delete-quotation-cargo');
Route::post('/quotation-service', 'QuotationServiceController@addQuotationService');
Route::post('/quotation-service-delete', 'QuotationServiceController@deleteQuotationService');
Route::get('/quotation/{id}', 'QuotationController@showQuotation')->name('show-quotation');
Route::get('/all-pdas', 'QuotationController@allPdas');
Route::get('/pdas/{status}', 'QuotationController@pdaStatus');
Route::get('/quotation/view/{id}', 'QuotationController@viewQuotation');
Route::get('/quotation/preview/{id}', 'QuotationController@previewQuotation');
Route::get('/quotation/send/{id}', 'QuotationController@sendToCustomer');
Route::get('/quotation/customer/accepted/{id}', 'QuotationController@customerAccept');
Route::get('/quotation/customer/declined/{id}', 'QuotationController@customerDecline');
Route::get('/all-notifications', 'NotificationController@index');
Route::get('/agency', 'AgencyController@index');
Route::post('/agency/approve', 'AgencyApprovalController@approve');
Route::post('/agency/remark', 'AgencyApprovalController@addRemark');
Route::post('/agency/disapprove', 'AgencyApprovalController@revision');
Route::get('/notifications/{id}', 'NotificationController@show');
Route::get('/quotation/request/{id}', 'QuotationController@requestQuotation');
//Route::get('/quotation/{id}/pdf', 'QuotationController@pdfQuotation');
Route::post('/update-service', 'QuotationServiceController@updateService');
Route::post('/notifying', 'NotifyingPartyController@notifying');

//next stage
Route::get('/quotation/convert/{id}', 'QuotationController@convertCustomer');
Route::get('/bill-of-lading/{id}', 'BillOfLandingController@edit');
Route::get('/test/', 'BillOfLandingController@test');
//dms
Route::get('/dms', 'DmsController@index');
Route::get('/dms', 'DmsController@index');
Route::get('/dms/edit/{id}', 'DmsController@edit');
Route::get('/dms/complete/{id}', 'DmsController@complete');
Route::get('/generate/laytime/{id}', 'DmsController@generateLayTime');
Route::post('/dms/store/', 'DmsController@store');
Route::post('/dms/add/sof', 'DmsController@addSof');
Route::post('/update-dms/', 'DmsController@updateDms');
Route::post('/vessel/doc/upload/', 'VesselDocsController@upload');

//stage
Route::resource('/stages', 'StageController');
Route::resource('/other-services-type', 'ExtraServiceTypeController');
Route::resource('/other-services', 'ExtraServiceController');
Route::resource('/stage-components', 'StageComponentController');

//generate docs
Route::get('/generate-documents/{type}/{id}', 'GenerateDocument@generateDocument');

