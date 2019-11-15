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
    Route::get('token_confirmation/{id}', 'api\v1\UserController@token_confirmation');
    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', 'api\v1\MenuController@all');
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['middleware' => ['verified']], function () {
            Route::post('details', 'api\v1\UserController@details');
        });
    });
});
