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

Route::get('/panel/plans', 'Api\Panel\PlansController@index');
Route::post('/panel/plans', 'Api\Panel\PlansController@store');
Route::get('/panel/plans/{plan}', 'Api\Panel\PlansController@show');
Route::put('/panel/plans/{plan}', 'Api\Panel\PlansController@update');
Route::delete('/panel/plans/{plan}', 'Api\Panel\PlansController@destroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
