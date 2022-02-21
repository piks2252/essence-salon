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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'UserController@index')->name('users.index');
    Route::delete('/:id', 'UserController@destroy')->name('users.destroy');
    Route::get('/home', 'UserController@index')->name('users.index');

    // Client module
    Route::resource('clients', 'ClientController');

    // Service module
    Route::resource('services', 'ServiceController');

    // Staff module
    Route::resource('staff', 'StaffController');

    // Invoice module
    Route::resource('invoices', 'InvoiceController');

    // staff report
    Route::post('/report', 'InvoiceController@report')->name('invoices.report');
  
});