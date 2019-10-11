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
Route::resource('/employee/leaves','Employee\LeavesController');
Route::get('/employee/apply_leaves/{id}','Employee\LeavesController@apply_leaves')->name('employee.apply_leaves');
Route::get('/hrd/employees/show_page/{id}/{tab}','HRD\EmployeesController@show_page')->name('employee.show_page');


//delete employees info

Route::delete('/hrd/employees/delete_row/{id}', 'HRD\EmployeesController@deleteEmp_detail')->name('emp_detail.delete');


Route::post('/hrd/employees/fetch_designation','HRD\EmployeesController@fetch_designation')->name('employees.fetch_designation');

Route::resource('/expenses/payments','Expenses\PaymentsController');

//Employee Save or Update Methods
Route::prefix('hrd')->namespace('HRD')->group(function () {
	Route::post('/employees/{type}', 'EmployeesController@getForm');
	Route::post('/employees/insert_employee','EmployeesController@insert_employee');
	Route::post('/employee/save_main/{id}', 'EmployeesController@save_main')->name('employees.main');
	Route::post('/employee/save_personal/{id}', 'EmployeesController@save_personal')->name('employees.personal');
	Route::post('/employee/save_official/{id}', 'EmployeesController@save_official')->name('employees.official');
	Route::post('/employee/save_academics/{id}', 'EmployeesController@save_academics')->name('employees.academics');
	Route::post('/employee/save_experience/{id}', 'EmployeesController@save_experience')->name('employees.experience');
	Route::post('/employee/save_documents/{id}', 'EmployeesController@save_documents')->name('employees.documents');
	Route::post('/employee/save_nominee/{id}', 'EmployeesController@save_nominee')->name('employees.nominee');
});
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
Route::resource('/settings/statuses','Settings\StatusController');
Route::resource('/settings/grades','Settings\GradesController');

Route::resource('/tender_master', 'Tender\TenderController');
Route::post('tender_master/{type}', 'Tender\TenderController@getForm');
Route::resource('/tender_type', 'Tender\TenderTypeController');
Route::resource('/tender_category', 'Tender\TenderCategoryController');
Route::group(['prefix' => 'tenders', 'namespace' => 'Tender'], function ()  {
	
});

// Master CRUD
Route::get('settings/mast_entity/{db_table}', 'MasterController@index')->name('mast_entity.all');
Route::get('settings/mast_entity', 'MasterController@start_page')->name('mast_entity.home');
Route::get('settings/mast_entity/{method}/{db_table}/{id?}', 'MasterController@createOrEditOrShow')->name('mast_entity.get');
Route::post('settings/mast_entity/{method}/{db_table}/{id?}', 'MasterController@storeOrUpdate')->name('mast_entity.post');
Route::delete('settings/mast_entity/{db_table}/{id}', 'MasterController@destroy')->name('mast_entity.delete');

//  Employee Leaves
Route::get('emp_leave','Employee\LeavesController@emp_leave')->name('emp_leave');
Route::post('emp_leave_store','Employee\LeavesController@store')->name('emp_leave_store');