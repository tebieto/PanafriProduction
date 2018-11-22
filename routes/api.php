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
    Route::post('login', [
        'uses' => 'LoginController@LoginUser',
	    'as' => 'LoginUser'
        ]);
});

Route::prefix('app')->group(function () {
    Route::post('register', [
        'uses' => 'RegisterController@registerUser',
	    'as' => 'registerUser'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('services', [
        'uses' => 'HomeController@services',
        'as' => 'appServices'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('categories', [
        'uses' => 'HomeController@categories',
        'as' => 'appCategories'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('requests', [
        'uses' => 'HomeController@requests',
        'as' => 'appRequests'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('chats', [
        'uses' => 'HomeController@requests',
        'as' => 'appChats'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('notifications', [
        'uses' => 'HomeController@requests',
        'as' => 'appNotifications'
        ]);
});


Route::group(['middleware' => ['jwt.verify']], function() {
    
    Route::prefix('app')->group(function () {
        Route::get('products', [
            'uses' => 'HomeController@products',
            'as' => 'appProducts'
            ]);
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
