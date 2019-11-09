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

Route::get('google_login', 'Auth\SocialAuthGoogleController@login');
Route::get('google_login_callback', 'Auth\SocialAuthGoogleController@login_callback');
Route::get('facebook_login', 'Auth\SocialAuthFacebookController@login');
Route::get('facebook_login_callback', 'Auth\SocialAuthFacebookController@login_callback');
Route::get('testing_ae/', 'TestingAeController@index');
Route::get('/', function () {
    return view('welcome');
});
