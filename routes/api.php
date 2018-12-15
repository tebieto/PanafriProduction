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

    Route::prefix('partner')->group(function () {
        Route::get('products', [
            'uses' => 'HomeController@PartnerProducts',
            'as' => 'partnerProducts'
            ]);
    });
    
    Route::prefix('partner')->group(function () {
        Route::get('services', [
            'uses' => 'HomeController@PartnerServices',
            'as' => 'partnerServices'
            ]);
    });
    
    Route::prefix('partner')->group(function () {
        Route::get('stores', [
            'uses' => 'HomeController@PartnerStores',
            'as' => 'partnerStores'
            ]);
    });

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

    Route::prefix('partner')->group(function () {
        Route::post('product', [
            'uses' => 'HomeController@saveProduct',
            'as' => 'saveProduct'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::post('edit/product', [
            'uses' => 'HomeController@editProduct',
            'as' => 'editProduct'
            ]);
    });


    Route::prefix('partner')->group(function () {
        Route::post('service', [
            'uses' => 'HomeController@saveService',
            'as' => 'saveService'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::post('edit/service', [
            'uses' => 'HomeController@editService',
            'as' => 'editService'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::post('save/image', [
            'uses' => 'HomeController@image64',
            'as' => 'image64'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::post('store', [
            'uses' => 'HomeController@saveStore',
            'as' => 'saveStore'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::post('edit/store', [
            'uses' => 'HomeController@editStore',
            'as' => 'editStore'
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

    Route::prefix('partner')->group(function () {
        Route::get('user/on/app', [
            'uses' => 'HomeController@onApp',
            'as' => 'onApp'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::get('user/off/app', [
            'uses' => 'HomeController@offApp',
            'as' => 'offApp'
            ]);
    });

    Route::prefix('app')->group(function () {
        Route::post('edit/user', [
            'uses' => 'RegisterController@editAppUser',
            'as' => 'editAppUser'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::post('edit/user', [
            'uses' => 'RegisterController@editAppUser',
            'as' => 'editPartnerUser'
            ]);
    });

    Route::prefix('app')->group(function () {
        Route::post('change/password', [
            'uses' => 'RegisterController@changeAppPassword',
            'as' => 'changeAppPassword'
            ]);
    });

    Route::prefix('partner')->group(function () {
        Route::post('change/password', [
            'uses' => 'RegisterController@changeAppPassword',
            'as' => 'changePartnerPassword'
            ]);
    });
    

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
