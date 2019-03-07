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
Route::get('/quotations', 'QuotationController@allQuotations');
Route::get('/customer-request/{customer_id}/{customer_type}', 'CustomerRequestController@customerRequest');
Route::resource('/good-types', 'GoodTypeController');
Route::resource('/leads', 'LeadController');
Route::resource('/tariffs', 'TariffController');
Route::resource('/departments', 'DepartmentController');
Route::post('/search-lead', 'LeadController@searchLeads');
Route::post('/search-dms', 'DmsController@searchDms');
Route::post('/search-customer', 'CustomerController@ajaxSearch');
Route::post('/lead-quotation', 'CustomerController@addLeadQuotation')->name('add-lead-quotation');
Route::post('/others-vessel-details', 'CustomerController@oVesselDetails');
Route::post('/voyage-details/{id}', 'CustomerController@voyageDetails')->name('add-quotation-voyage');
Route::post('/update-voyage/{id}', 'CustomerController@updateVoyageDetails')->name('update-quotation-voyage');
Route::post('/consignee-details/{id}', 'CustomerController@consigneeDetails')->name('add-quotation-consignee');
Route::post('/update-vessel-details/{id}', 'CustomerController@updateVesselDetails')->name('update-quotation-vessel');
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
Route::post('/quotation/send/{id}', 'QuotationController@sendToCustomer')->name('send-customer-quotation');

// lead quotation accept or decline
Route::get('/accept/{identifier}','QuotationController@customerAccept')->name('client-accept-quotation');
Route::get('/decline/{identifier}', 'QuotationController@customerDecline')->name('client-decline-quotation');

// client quotation response recived url
Route::view('/received','client-response-view')->name('client-quotation-response');

// user quotation accept or decline
Route::get('/quotation/customer/accepted/{id}', 'QuotationController@userAcceptCustomerQuotation')->name('user-accept-client-quotation');
Route::get('/quotation/customer/declined/{id}', 'QuotationController@userDeclineCustomerQuotation')->name('user-decline-client-quotation');

Route::get('/all-notifications', 'NotificationController@index');
Route::get('/agency', 'AgencyController@index');
Route::post('/agency/approve', 'AgencyApprovalController@approve');
Route::post('/agency/remark', 'AgencyApprovalController@addRemark')->name('add-quotation-remark');
Route::post('/agency/remark/delete/{id}', 'AgencyApprovalController@deleteRemark')->name('delete-quotation-remark');
Route::post('/agency/remark/update/{id}', 'AgencyApprovalController@updateRemark')->name('edit-quotation-remark');
Route::post('/agency/disapprove', 'AgencyApprovalController@revision');
Route::get('/notifications/{id}', 'NotificationController@show');
Route::get('/quotation/request/{id}', 'QuotationController@requestQuotation');
Route::get('/quotation/approve/{id}', 'QuotationController@managerAprroveQuotation')->name('manager-approve-quotation');
Route::post('/quotation/disapprove/{id}', 'QuotationController@managerDisaprroveQuotation')->name('manager-disapprove-quotation');
Route::get('/quotation/allow/{id}', 'QuotationController@allowForProcessing')->name('allow-for-processing');
//Route::get('/quotation/{id}/pdf', 'QuotationController@pdfQuotation');
Route::post('/update-service', 'QuotationServiceController@updateService');
Route::post('/notifying', 'NotifyingPartyController@notifying')->name('add-quotation-notifee');
Route::post('/update-notifiee/{id}', 'NotifyingPartyController@updateNotifiee')->name('update-quotation-notifee');

//next stage
Route::get('/quotation/convert/{id}', 'QuotationController@convertCustomer')->name('convert-customer');
Route::get('/bill-of-lading/{id}', 'BillOfLandingController@edit');
Route::get('/test/', 'BillOfLandingController@test');
//dms
Route::get('/dms', 'DmsController@index');
Route::get('/dms', 'DmsController@index');
Route::get('/dms/edit/{id}/{budget?}', 'DmsController@edit')->name('edit-bill-of-landing');
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

//roles
Route::resource('/roles','RolesController');

//permissions
Route::resource('/permissions','PermissionsController');

//users
Route::resource('/users', 'UserController');

// quotation funds
Route::post('/quotation/funds', 'FundsController@saveFund')->name('save-quotation-fund');

// service cost
Route::post('/quotation/service-cost', 'ServiceCostController@saveServiceCost')->name('save-service-cost');

//purchase order
Route::get('/generate-po/{id}','PurchaseOrderController@index')->name('generate-po');
Route::post('/save-po/{id}','PurchaseOrderController@savePo')->name('save-po');