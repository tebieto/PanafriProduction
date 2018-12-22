<?php

namespace App\Http\Controllers;
Use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\profile;
use App\product;
use App\AppRequest;
use App\review;
use App\Shop;
use App\category;
use DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    
    public function authSeller(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/login/seller/login');
        } else {
			Session::flash('error', 'Account not found.');
			return redirect()->intended('login/seller/login');
			
		}
    }

    
    public function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            $update= profile::where('user_id', auth::id())->first()		
	        ->update([
            'about' =>$request->deviceToken,
            ]);

            return response()->json(compact('token'));
    }

     public function loginPartner(Request $request)
    {
        $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            $update= profile::where('user_id', auth::id())->first()		
	        ->update([
            'about' =>$request->deviceToken,
            ]);

        $products = Product::select("id")->where('type', 1)->where('owner', auth::id())->orderBy(DB::raw('RAND()'))->get()->count();
        $services = Product::select("id")->where('type', 2)->where('owner', auth::id())->orderBy(DB::raw('RAND()'))->get()->count();
        $customers = AppRequest::select("buyer_id")->where('status', 0)->where('seller_id', auth::id())->groupBy('buyer_id')->get()->count();
        $requests = AppRequest::select("buyer_id")->where('seller_id', auth::id())->get()->count();
        $reviews = Review::select("partner_id")->where('partner_id', auth::id())->get()->count();
        $earnings = 0;
        $sales = AppRequest::select("product_id")->where('status', 1)->where('seller_id', auth::id())->get();
	   
        foreach ($sales as $sale):
        
        $earnings = $earnings + $sale->product->price;
        
        endforeach;

        return response()->json(compact('token', 'products','reviews', 'services', 'customers', 'earnings', 'requests' ),201);
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            $update= profile::where('user_id', auth::id())->first()		
	        ->update([
            'about' =>$request->deviceToken,
            ]);

            if((auth::user()->role)<2) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }

        $products = Product::select("id")->where('type', 1)->orderBy(DB::raw('RAND()'))->get()->count();
        $services = Product::select("id")->where('type', 2)->orderBy(DB::raw('RAND()'))->get()->count();
        $partners = Product::select("owner")->groupBy('owner')->get()->count();
        $requests = AppRequest::select("buyer_id")->get()->count();
        $reviews = Review::select("partner_id")->get()->count();
        $categories = Category::select("id")->get()->count();
        $stores = Shop::select("id")->get()->count();
        $users = User::select("id")->get()->count();
    
        return response()->json(compact('token', 'products','reviews', 'users', 'services', 'categories', 'stores', 'partners', 'requests' ),201);
    }

    
}