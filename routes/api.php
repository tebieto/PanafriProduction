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

Route::prefix('app')->group(function () {
    Route::get('products', [
        'uses' => 'HomeController@products',
        'as' => 'appProducts'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('services', [
        'uses' => 'HomeController@services',
        'as' => 'appServices'
        ]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
