<?php

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
Route::prefix('v1')->group(function (){
    Route::post('login', 'api\v1\UserController@login');
    Route::post('register', 'api\v1\UserController@register');

    Route::group(['prefix' => 'banner'], function () {
        Route::get('active_banner/', 'api\v1\BannerController@active_banner');
    });

    Route::group(['prefix' => 'testimoni'], function () {
        Route::get('active_testimoni/', 'api\v1\TestimoniController@active_testimoni');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', 'api\v1\MenuController@all');
    });

    Route::group(['prefix' => 'vendor'], function () {
        Route::post('partnership_request', 'api\v1\VendorController@partnership_request');
    });

    Route::group(['prefix' => 'konsumen'], function () {
        Route::get('activated_membership/', 'api\v1\CustomerController@get_activated_membership');
    });
    
    Route::get('token_confirmation/{id}', 'api\v1\UserController@token_confirmation');
    
    Route::group(['middleware' => 'auth:api'], function () {
        // authenticated account needed
        Route::post('details', 'api\v1\UserController@details');
        
        // verified account needed
        Route::group(['middleware' => ['verified']], function () {
            
            // routes for cart
            Route::group(['prefix' => 'cart'], function () {
                Route::get('all/', 'api\v1\CartController@all');
                Route::post('store/', 'api\v1\CartController@store');
                Route::match(['PUT', 'PATCH'], 'quantity_change/', 'api\v1\CartController@quantity_change');
                Route::delete('destroy/', 'api\v1\CartController@destroy');
            });

            // routes for cart
            Route::group(['prefix' => 'order'], function () {
                Route::post('store/', 'api\v1\OrderController@store');
                Route::get('detail/{code}', 'api\v1\OrderController@detail');
            });

            // routes for konsumen
            Route::group(['prefix' => 'konsumen'], function () {
                Route::post('request_membership/', 'api\v1\CustomerController@membership_request');
                Route::get('get_membership_request/', 'api\v1\CustomerController@get_membership_request');
                Route::get('profile/', 'api\v1\CustomerController@profile');
            });

            // routes for payment
            Route::group(['prefix' => 'payment'], function () {
                Route::post('confirm/', 'api\v1\PaymentController@confirm');
            });
        });
    });
});
