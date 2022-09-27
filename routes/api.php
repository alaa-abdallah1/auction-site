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

/* log in / out Routes */

Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout');

Route::get('items', 'ItemController@index');
Route::get('items/{item}', 'ItemController@show');

Route::middleware(['auth:api'])->group(function () {
    Route::put('items/{item}', 'ItemController@update');
    Route::post('items/{item}/auto-bid', 'ItemController@autoBid');
    Route::delete('/auto-bid/{item}', 'AutoBidController@delete');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
