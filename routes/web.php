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
Route::resource('/expenses/payments','Expenses\PaymentsController');

Route::post('/expenses/accounts','Expenses\PaymentsController@account_mast')->name('account_mast');
Route::post('/expenses/vendor_mast','Expenses\PaymentsController@vendor_mast')->name('vendor_mast');
Route::get('payments/export/', 'Expenses\PaymentsController@export')->name('payments.export');
Route::post('payments/imports/', 'Expenses\PaymentsController@import')->name('payments.imports');


Route::resource('/settings/expense_in_user','Settings\ExpenseUserController');
Route::resource('/settings/expense_permit_user','Settings\ExpensePermitUserController');
Route::resource('/settings/categories','Settings\CategoryController');
