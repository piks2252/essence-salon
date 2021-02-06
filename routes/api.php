<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api'],'prefix' => 'v1'], function () {
    // Route::middleware(['jwt.auth','validate.user'])->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::post('register', 'Api\UserController@register');
    Route::post('login', 'Api\UserController@login');
    Route::post('forgot-password', 'Api\UserController@forgotPassword');
    Route::group(['middleware' => ['jwt.auth','validate.user']], function () {
        // user module
        Route::post('user', 'Api\UserController@getAuthUser');
        Route::post('update-profile', 'Api\UserController@updateProfile');
        Route::post('change-password', 'Api\UserController@changePassword');
        Route::post('change-notification-type', 'Api\UserController@changeNotificationType');
        Route::post('logout', 'Api\UserController@logout');

        //  Affirmation module
        Route::post('affirmation-quote', 'Api\AffirmationQuoteController@index');
        //  Route::get('setAffirmationId', 'Api\AffirmationQuoteController@setAffirmationId');
        Route::post('get-affirmation-quote', 'Api\AffirmationQuoteController@getAffirmationQuote');

        // audio modulu
        Route::post('audios', 'Api\AudioController@index');

        // video modulu
        Route::post('videos', 'Api\VideoController@index');

        // purchase book module
        Route::post('purchase-book', 'Api\PurchaseBookController@purchasePdf');
        
        // service module
        Route::post('services', 'Api\ServiceController@index');

        // store table details module
        Route::post('table-details', 'Api\StoreTableDetailController@index');
        Route::post('table-detail/store', 'Api\StoreTableDetailController@store');
        // Route::post('table-detail/{id}/update', 'Api\StoreTableDetailController@update');
        Route::post('table-detail/delete', 'Api\StoreTableDetailController@destroy');

        // Payment Transcation module
        Route::post('payments', 'Api\PaymentController@index');
        Route::post('payment/store', 'Api\PaymentController@store');
        
        
    });
    // cron for set affirmation id
    Route::get('set-affirmation-id-cron', 'Api\AffirmationQuoteController@setAffirmationIdCron');
});
