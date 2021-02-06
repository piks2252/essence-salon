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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/home', 'HomeController@index')->name('home');
    // Route::get('/', 'HomeController@index')->name('home');
    Route::get('/', 'UserController@index')->name('users.index');
    Route::get('/home', 'UserController@index')->name('users.index');

    // Client module
    Route::resource('clients', 'ClientController');

    // Service module
    Route::resource('services', 'ServiceController');

    // Staff module
    Route::resource('staff', 'StaffController');

    // Invoice module
    Route::resource('invoices', 'InvoiceController');

    // Category module
    Route::resource('categories', 'CategoryController');

    // Product module
    Route::resource('products', 'ProductController');
    Route::post('products/add-quot', 'ProductController@setProductInSession');
    Route::post('products/remove-quot', 'ProductController@removeProductFromSession');

    // Product module
    Route::resource('quotations', 'QuotationController');

    // Affirmation Quote module
    Route::resource('affirmation-quote', 'AffirmationQuoteController');
    
    // Affirmation Image module
    Route::resource('affirmation-image', 'AffirmationImageController');

    // User module
    Route::get('users', 'UserController@index')->name('users.index');
    Route::delete('users/{id}', 'UserController@destroy')->name('users.destroy');

    // Subscription(Service) module
    Route::get('services', 'ServiceController@index')->name('services.index');
    Route::get('services/{id}/edit', 'ServiceController@edit')->name('services.edit');
    Route::put('services/{id}', 'ServiceController@update')->name('services.update');

    // Payment & Transaction module
    Route::get('payments', 'PaymentController@index')->name('payments.index');

    // Terms&Conditation module
    Route::get('terms-condition', 'PaymentController@index')->name('payments.index');
});
Route::get('/reset-success', function () {
    return view('common.resetPasswordSuccessUser');
});
Route::get('/terms-condition', function () {
    return view('terms-condition.index');
});