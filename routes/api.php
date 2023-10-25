<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Path: routes/api.php
Route::group(['prefix' => 'api/v1'], function () {
    Route::post('admin/register', 'Auth\AdminRegisterController@register');
    Route::post('admin/login', 'Auth\AdminLoginController@login');

    Route::post('user/register', 'Auth\UserRegisterController@register');
    Route::post('user/login', 'Auth\UserLoginController@login');
});
