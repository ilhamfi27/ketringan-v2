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

    Route::group(['prefix' => 'home'], function () {
        Route::get('main_screen/', 'api\v1\HomeController@mainScreen');
    });

    Route::group(['prefix' => 'banner'], function () {
        Route::get('active_banner/', 'api\v1\BannerController@active_banner');
    });

    Route::group(['prefix' => 'testimoni'], function () {
        Route::get('active_testimoni/', 'api\v1\TestimoniController@active_testimoni');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', 'api\v1\MenuController@all');
        Route::get('categories/', 'api\v1\MenuController@getKategoriByJenis');
    });

    Route::group(['prefix' => 'vendor'], function () {
        Route::post('partnership_request', 'api\v1\VendorController@partnership_request');
    });

    Route::group(['prefix' => 'konsumen'], function () {
        Route::get('activated_membership/', 'api\v1\CustomerController@get_activated_membership');
    });

    Route::group(['prefix' => 'region'], function () {
        Route::get('all/', 'api\v1\RegionController@all');
    });

    // routes for discount
    Route::group(['prefix' => 'discount'], function () {
        Route::get('all_voucher/', 'api\v1\DiscountController@allVoucher');
    });

    // routes for bank
    Route::group(['prefix' => 'bank'], function () {
        Route::get('/', 'api\v1\BankController@all');
        Route::get('/{id}', 'api\v1\BankController@show');
    });
    
    Route::get('token_confirmation/{id}', 'api\v1\UserController@token_confirmation');
    
    Route::group(['middleware' => 'auth:api'], function () {
        // authenticated account needed
        Route::post('details', 'api\v1\UserController@details');
        
        Route::group(['prefix' => 'user'], function () {
            Route::post('update', 'api\v1\UserController@updateCredentials');
            Route::get('regenerate_token', 'api\v1\UserController@regenerateToken');
        });

        Route::group(['prefix' => 'konsumen'], function () {
            Route::get('profile/', 'api\v1\CustomerController@profile');
        });
        
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
                Route::post('profile_edit/', 'api\v1\CustomerController@profileEdit');
                Route::get('order_list/', 'api\v1\CustomerController@orderList');
            });

            // routes for payment
            Route::group(['prefix' => 'payment'], function () {
                Route::post('confirm/', 'api\v1\PaymentController@confirm');
            });

            // routes for discount
            Route::group(['prefix' => 'discount'], function () {
                Route::post('use_voucher/', 'api\v1\DiscountController@useVoucher');
            });

            Route::group(['prefix' => 'menu'], function () {
                Route::post('suggest_order/', 'api\v1\MenuController@suggestOrder');
            });
        });
    });
});
