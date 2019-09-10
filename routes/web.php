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
Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/expenses/bills','Expenses\BillsController');
Route::resource('/expenses/vendors','Expenses\VendorsController');
Route::resource('/expenses/tours','Expenses\ToursController');
Route::resource('/hrd/approvals','HRD\ApprovalsController');
Route::resource('/hrd/employees','HRD\EmployeesController');
Route::post('hrd/employees/{type}', 'HRD\EmployeesController@getForm');
Route::post('/hrd/employees/fetch_designation','HRD\EmployeesController@fetch_designation')->name('employees.fetch_designation');
Route::post('/hrd/employees/insert_employee','HRD\EmployeesController@insert_employee');
Route::resource('/expenses/payments','Expenses\PaymentsController');

Route::post('/expenses/accounts','Expenses\PaymentsController@account_mast')->name('account_mast');
Route::post('/expenses/vendor_mast','Expenses\PaymentsController@vendor_mast')->name('vendor_mast');
Route::get('payments/export/', 'Expenses\PaymentsController@export')->name('payments.export');
Route::post('payments/imports/', 'Expenses\PaymentsController@import')->name('payments.imports');

//Tours
Route::get('expenses/tour/tour_stages/{id}','Expenses\ToursController@tour_stages')->name('tour.tour_stages');
Route::get('expenses/tour/approve/{id}','Expenses\ToursController@approve')->name('tour.approve');
Route::get('expenses/tour/start/{id}','Expenses\ToursController@start')->name('tour.start');
Route::get('expenses/tour/end/{id}','Expenses\ToursController@end')->name('tour.end');
Route::get('expenses/tour/decline/{id}','Expenses\ToursController@decline')->name('tour.decline');
// HRD module
Route::get('employees/export/', 'HRD\EmployeesController@export')->name('employees.export');

Route::resource('/settings/expense_in_user','Settings\ExpenseUserController');
Route::resource('/settings/expense_permit_user','Settings\ExpensePermitUserController');
Route::resource('/settings/categories','Settings\CategoryController');
Route::resource('/settings/designations','Settings\DesignationController');
Route::resource('/settings/grades','Settings\GradesController');

Route::resource('/tender_master', 'Tender\TenderController');
Route::post('tender_master/{type}', 'Tender\TenderController@getForm');
Route::resource('/tender_type', 'Tender\TenderTypeController');
Route::resource('/tender_status', 'Tender\TenderStatusController');
Route::group(['prefix' => 'tenders', 'namespace' => 'Tender'], function ()  {
	
});
