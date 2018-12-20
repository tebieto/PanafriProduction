<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\profile;
use App\AppRequest;
use App\product;
use DB;
use Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //Handles registration request for seller
    public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create seller
        $seller = $this->create($request->all());

        //Authenticates seller
       $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
           return redirect()->intended('login/seller/login');
        }
    }
    

    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
			'phone' => 'required|string|max:11|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        //Create user
        $user = $this->create($request->all());

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

        return response()->json(compact('user','token'),201);

    }

    public function registerPartner(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
			'phone' => 'required|string|max:11|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        //Create user
        $user = $this->create($request->all());
        $products = Product::select("id")->where('type', 1)->where('owner', auth::id())->orderBy(DB::raw('RAND()'))->get()->count();
        $services = Product::select("id")->where('type', 2)->where('owner', auth::id())->orderBy(DB::raw('RAND()'))->get()->count();
        $customers = AppRequest::select("buyer_id")->where('status', 1)->where('seller_id', auth::id())->groupBy('buyer_id')->get()->count();
        $requests = AppRequest::select("buyer_id")->where('seller_id', auth::id())->get()->count();
        $reviews = Review::select("partner_id")->where('partner_id', auth::id())->get()->count();
        $earnings = 0;
        $sales = AppRequest::select("product_id")->where('status', 1)->where('seller_id', auth::id())->get();
	   
        foreach ($sales as $sale):
        
        $earnings = $earnings + $sale[0]->product->price;
        
        endforeach;

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

        return response()->json(compact('token', 'products', 'reviews', 'services', 'customers', 'earnings', 'requests' ),201);

    }


   
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register/seller/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
	
       return Validator::make($data, [
           'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
			'phone' => 'required|string|max:11|unique:users',
            'password' => 'required|string|min:6|confirmed',
			
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       	
		$avatar = 'public/default/avatars/default-avatar.png';	
		$avatar = asset(Storage::url($avatar));
		
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'phone' => $data['phone'],
			'status' => 0,
			'online' => 1,
			'avatar' => $avatar,
			'role' => 0,
            'password' => bcrypt($data['password']),
        ]);
		
		profile::create(['user_id' => $user->id]);
		
		return $user;
    }
}
