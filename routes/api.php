<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('staff', 'App\Http\Controllers\StaffApiController@index');
Route::get('staff/{staff}', 'App\Http\Controllers\StaffApiController@show');
Route::post('staff', 'App\Http\Controllers\StaffApiController@store');
Route::put('staff/{staff}', 'App\Http\Controllers\StaffApiController@update');
Route::delete('staff/{staff}', 'App\Http\Controllers\StaffApiController@delete');
