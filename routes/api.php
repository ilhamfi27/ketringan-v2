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
        Route::get('activated_membership/', 'api\v1\KonsumenController@get_activated_membership');
    });
    
    Route::get('token_confirmation/{id}', 'api\v1\UserController@token_confirmation');
    
    Route::group(['middleware' => 'auth:api'], function () {
        // authenticated account needed
        
        // verified account needed
        Route::group(['middleware' => ['verified']], function () {
            Route::post('details', 'api\v1\UserController@details');
            Route::group(['prefix' => 'konsumen'], function () {
                Route::post('request_membership/', 'api\v1\KonsumenController@membership_request');
                Route::get('get_membership_request/', 'api\v1\KonsumenController@get_membership_request');
            });
        });
    });
});
