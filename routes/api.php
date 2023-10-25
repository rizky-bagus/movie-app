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
    Route::post('admin/register', 'Api\Auth\AdminRegisterController@register');
    Route::post('admin/login', 'Api\Auth\AdminLoginController@login');

    Route::post('user/register', 'Api\Auth\UserRegisterController@register');
    Route::post('user/login', 'Api\Auth\UserLoginController@login');

    Route::post('movies', 'Api\MovieController@createMovie');
    Route::put('movies/{id}', 'Api\MovieController@updateMovie');
    Route::get('movies/most-viewed', 'Api\MovieController@mostViewed');
    Route::get('movies', 'Api\MovieController@listMovies');
    Route::get('movies/search', 'Api\MovieController@searchMovies');
    Route::post('movies/{id}/track-viewership', 'Api\MovieController@trackViewership');

    // Route::middleware('auth:api')->group(function () {
        Route::post('votes/{movieId}', 'Api\VoteController@voteMovie');
        Route::delete('votes/{movieId}', 'Api\VoteController@unvoteMovie');
        Route::get('votes', 'Api\VoteController@userVotedMovies');
        Route::get('votes/most-voted', 'Api\VoteController@mostVoted');
        Route::get('votes/most-voted-genre', 'Api\VoteController@mostVotedGenre');
    // });

});
