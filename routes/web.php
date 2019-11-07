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

Route::get('google_register', 'SocialAuthGoogleController@register');
Route::get('google_register_callback', 'SocialAuthGoogleController@google_register_callback');
Route::get('testing_ae/', 'TestingAeController@index');
Route::get('/', function () {
    return view('welcome');
});
