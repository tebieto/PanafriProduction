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

Route::prefix('partner')->group(function () {
    Route::get('products', [
        'uses' => 'HomeController@PartnerProducts',
        'as' => 'partnerProducts'
        ]);
});

Route::prefix('app')->group(function () {
    Route::post('login', [
        'uses' => 'LoginController@LoginUser',
	    'as' => 'LoginUser'
        ]);
});

Route::prefix('partner')->group(function () {
    Route::post('login', [
        'uses' => 'LoginController@LoginPartner',
	    'as' => 'LoginPartner'
        ]);
});

Route::prefix('app')->group(function () {
    Route::post('register', [
        'uses' => 'RegisterController@registerUser',
	    'as' => 'registerUser'
        ]);
});

Route::prefix('partner')->group(function () {
    Route::post('register', [
        'uses' => 'RegisterController@registerPartner',
	    'as' => 'registerPartner'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('services', [
        'uses' => 'HomeController@services',
        'as' => 'appServices'
        ]);
});

Route::prefix('partner')->group(function () {
    Route::get('services', [
        'uses' => 'HomeController@PartnerServices',
        'as' => 'partnerServices'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('categories', [
        'uses' => 'HomeController@categories',
        'as' => 'appCategories'
        ]);
});

Route::prefix('partner')->group(function () {
    Route::get('categories', [
        'uses' => 'HomeController@categories',
        'as' => 'partnerCategories'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('category/{name}', [
        'uses' => 'ApiController@category',
        'as' => 'appCategory'
        ]);
});

Route::prefix('partner')->group(function () {
    Route::get('category/{name}', [
        'uses' => 'ApiController@category',
        'as' => 'partnerCategory'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('seller/{id}', [
        'uses' => 'ApiController@appSeller',
        'as' => 'appSeller'
        ]);
});

Route::prefix('partner')->group(function () {
    Route::get('buyer/{id}', [
        'uses' => 'ApiController@appBuyer',
        'as' => 'appBuyer'
        ]);
});

Route::prefix('app')->group(function () {
    Route::get('search/{name}', [
        'uses' => 'ApiController@search',
        'as' => 'appSearch'
        ]);
});

Route::prefix('partner')->group(function () {
    Route::get('search/{name}', [
        'uses' => 'ApiController@search',
        'as' => 'partnerSearch'
        ]);
});


Route::group(['middleware' => ['jwt.verify']], function() {
    
    Route::prefix('app')->group(function () {
        Route::get('user', [
            'uses' => 'HomeController@getAuthenticatedUser',
            'as' => 'appUser'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::get('user', [
            'uses' => 'HomeController@getAuthenticatedUser',
            'as' => 'appPartner'
            ]);
    });

    Route::prefix('app')->group(function () {
        Route::post('request', [
            'uses' => 'HomeController@AppRequest',
            'as' => 'AppRequest'
            ]);
    });

    Route::prefix('app')->group(function () {
        Route::get('requests', [
            'uses' => 'HomeController@AppRequests',
            'as' => 'AppRequests'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::get('requests', [
            'uses' => 'HomeController@PartnerRequests',
            'as' => 'PartnerRequests'
            ]);
    });
    
    Route::prefix('app')->group(function () {
        Route::get('chats', [
            'uses' => 'HomeController@chat',
            'as' => 'appChats'
            ]);
    });

    Route::prefix('app')->group(function () {
        Route::get('notifications', [
            'uses' => 'HomeController@note',
            'as' => 'appNotifications'
            ]);
    });
    

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
