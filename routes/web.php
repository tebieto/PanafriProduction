<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', function () {
	if (auth::check()) {

	return view('dashboard');	
		
	}
    return view('public');
});


Route::get('/buyers/transactions', function () {
	if (auth::check()) {

    return view('transactions');
	}
    return view('public');
});

Route::get('/transactions/sellers/transactions', function () {
    if (auth::check()) {
	return view('sellertransactions');
	}
    return view('public');
});



Route::get('/buyers/pending/transactions', function () {
    if (auth::check()) {
	return view('buyerpending');
	}
    return view('public');
});

Route::get('/check/auth', function () {
	if (auth::check()) {
		
    return 1;
	
	} else {
	return 0;	
	}
});

Route::get('/home', 'HomeController@index')->name('dashboard');

Route::get('/save/category/{name}', [
	'uses' => 'HomeController@saveCategory',
	'as' => 'category'
	]);
	
Route::get('/all/categories', [
	'uses' => 'HomeController@categories',
	'as' => 'categories'
	]);
	
Route::get('/all/products', [
	'uses' => 'HomeController@products',
	'as' => 'products'
	]);
	
	
Route::get('/get/all/shops/{start}', [
	'uses' => 'ShopController@allShops',
	'as' => 'allShops'
	]);
	
Route::get('/get/shop/items/{id}', [
	'uses' => 'ShopController@shopItems',
	'as' => 'shopItems'
	]);
	
Route::get('/get/shop/location/{id}', [
	'uses' => 'ShopController@shopLocation',
	'as' => 'shopLocation'
	]);
	
Route::get('/get/shop/owner/{id}', [
	'uses' => 'ShopController@shopOwner',
	'as' => 'shopOwner'
	]);
	
Route::get('/get/item/owner/{store}', [
	'uses' => 'ShopController@itemOwner',
	'as' => 'itemOwner'
	]);
	
Route::get('/get/product/owner/{product}', [
	'uses' => 'ShopController@productOwner',
	'as' => 'productOwner'
	]);
	
Route::get('/get/item/Prices/{id}', [
	'uses' => 'ShopController@itemPrices',
	'as' => 'itemPrices'
	]);
	
Route::get('/create/transaction/tracker/{store}/{owner}', [
	'uses' => 'ShopController@createTracker',
	'as' => 'createTracker'
	]);
	
Route::get('/add/to/cart/{product}/{price}/{quantity}', [
	'uses' => 'ShopController@addToCart',
	'as' => 'addToCart'
	]);
	
Route::get('/get/pending/transactions', [
	'uses' => 'ShopController@pendingTransactions',
	'as' => 'pendingTransactions'
	]);
	
Route::get('/get/pending/trackers', [
	'uses' => 'ShopController@pendingTrackers',
	'as' => 'pendingTrackers'
	]);
	
	
Route::get('/get/request/trackers', [
	'uses' => 'ShopController@requestTrackers',
	'as' => 'requestTrackers'
	]);
	
Route::get('/get/user/details/{id}', [
	'uses' => 'HomeController@userDetails',
	'as' => 'userDetails'
	]);
	

	
Route::get('/get/shop/details/{shop}', [
	'uses' => 'ShopController@shopDetails',
	'as' => 'shopDetails'
	]);
	
Route::get('/get/tracked/transactions/{tracker}', [
	'uses' => 'ShopController@trackedTransactions',
	'as' => 'trackedTransactions'
	]);
	
Route::get('/cancel/transaction/{tracker}', [
	'uses' => 'ShopController@cancelTransaction',
	'as' => 'cancelTransaction'
	]);
	
Route::get('/request/transaction/{tracker}', [
	'uses' => 'ShopController@requestTransaction',
	'as' => 'requestTransaction'
	]);
	
Route::get('/accept/transaction/{tracker}/{delivery}', [
	'uses' => 'ShopController@acceptTransaction',
	'as' => 'acceptTransaction'
	]);
	
Route::get('/delete/transaction/{id}', [
	'uses' => 'ShopController@deleteTransaction',
	'as' => 'deleteTransaction'
	]);
	
Route::get('/sell/products/{cid}/{pid}', [
	'uses' => 'HomeController@sellProduct',
	'as' => 'sellproduct'
	]);
	
Route::get('/auth/store', [
	'uses' => 'HomeController@authStore',
	'as' => 'authStore'
	]);
	
Route::get('/check/store/{pid}', [
	'uses' => 'HomeController@checkStore',
	'as' => 'checkStore'
	]);
	
Route::get('/open/transactions', [
	'uses' => 'HomeController@openTransactions',
	'as' => 'openTransactions'
	]);
	
Route::get('/decline/transaction/{tid}', [
	'uses' => 'HomeController@declineTransaction',
	'as' => 'declineTransaction'
	]);
	
Route::get('/auth/details/', [
	'uses' => 'HomeController@authDetails',
	'as' => 'authDetails'
	]);
	
Route::get('/auth/shops/', [
	'uses' => 'HomeController@authShops',
	'as' => 'authShops'
	]);
	
	
Route::get('/closed/transactions', [
	'uses' => 'HomeController@closedTransactions',
	'as' => 'closedTransactions'
	]);
	
	
Route::get('/find/sellers/{pid}/{cid}', [
	'uses' => 'HomeController@findSellers',
	'as' => 'findSellers'
	]);
	
Route::get('/active/product/{pid}', [
	'uses' => 'HomeController@activeProduct',
	'as' => 'activeProduct'
	]);
	
Route::get('/remove/product/{pid}', [
	'uses' => 'HomeController@removeProduct',
	'as' => 'removeProduct'
	]);
	
Route::get('/get/chat/{tid}', [
	'uses' => 'HomeController@getChat',
	'as' => 'getChat'
	]);
	
Route::get('/on/product/{pid}', [
	'uses' => 'HomeController@onProduct',
	'as' => 'onProduct'
	]);
	
Route::get('/off/product/{pid}', [
	'uses' => 'HomeController@offProduct',
	'as' => 'offProduct'
	]);
	
	
Route::get('/on/store/{sid}', [
	'uses' => 'HomeController@onStore',
	'as' => 'onStore'
	]);
	
Route::get('/off/store/{sid}', [
	'uses' => 'HomeController@offStore',
	'as' => 'offStore'
	]);
	
	
	
	
	
	
Route::get('/on/app', [
	'uses' => 'HomeController@onApp',
	'as' => 'onApp'
	]);
	
Route::get('/off/app', [
	'uses' => 'HomeController@offApp',
	'as' => 'offApp'
	]);
	
	
	
Route::get('/get/prices/{pid}', [
	'uses' => 'HomeController@getPrices',
	'as' => 'getPrices'
	]);
	
Route::get('/remove/prices/{pid}', [
	'uses' => 'HomeController@removePrices',
	'as' => 'removePrices'
	]);
	
Route::get('/products/store/{sid}', [
	'uses' => 'HomeController@getStoreProducts',
	'as' => 'getStoreProducts'
	]);
	
Route::get('/create/transaction/{sid}/{pid}/{cid}', [
	'uses' => 'HomeController@createTransaction',
	'as' => 'createTransaction'
	]);
	
Route::post('/upload/image', [
	'uses' => 'HomeController@image',
	'as' => 'image'
	]);	
	
	
Route::post('/send/chat', [
	'uses' => 'HomeController@sendChat',
	'as' => 'sendChat'
	]);	
	
Route::post('/submit/product', [
	'uses' => 'HomeController@submitProduct',
	'as' => 'product'
	]);
	
Route::post('/send/price', [
	'uses' => 'HomeController@sendPrice',
	'as' => 'sendPrice'
	]);
	
Route::post('/login/seller/login', [
	'uses' => 'LoginController@authSeller',
	'as' => 'authSeller'
	]);
	
Route::post('/register/seller/register', [
	'uses' => 'RegisterController@register',
	'as' => 'registerSeller'
	]);
	
Route::get('/login/seller/login', function () {
	if(auth::check()) {
		
	return view('seller');	
		
	}
    return view('sellerLogin');
});

Route::get('/register/seller/register', function () {
	if(auth::check()) {
		
	return view('seller');	
		
	}
    return view('sellerRegistration');
});

	
Route::post('/submit/seller', [
	'uses' => 'HomeController@submitSeller',
	'as' => 'submitseller'
	]);
	
Route::post('/save/shop', [
	'uses' => 'HomeController@saveShop',
	'as' => 'saveShop'
	]);
	
Route::post('/map', function (Request $request) {
    $lat = $request->input('lat');
    $long = $request->input('long');
    $location = ["lat"=>$lat, "long"=>$long];
    event(new SendLocation($location));
    return response()->json(['status'=>'success', 'data'=>$location]);
});

	
Route::group(['middleware' => ['auth']], function () {
    //only authorized users can access these routes
});

Route::group(['middleware' => ['guest']], function () {
    //only guests can access these routes
	
	Route::get('guest/all/products', [
	'uses' => 'Controller@guestproducts',
	'as' => 'guestproducts'
	]);
});