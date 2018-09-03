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

Route::apiResource('movie', 'Api\MovieController');
Route::apiResource('member', 'Api\MemberController');
Route::apiResource('lending', 'Api\LendingController');

Route::get('member-active', 'Api\MemberController@memberActive');
