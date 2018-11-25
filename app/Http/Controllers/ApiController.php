<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\User;
use App\category;
use App\product;
use App\Transaction;
use App\Requests;
use App\Chat;
use App\referral;
use App\Store;
use App\Location;
use App\Price;
use Auth;
use DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
    public function category($name)
    {
	  $all= array();
      
		
	   $products = Product::where('category', $name)->orderBy(DB::raw('RAND()'))->get();
	   
	   foreach ($products as $product):
	   array_push($all, $product);
	   
	   endforeach;
	   $all= array_slice($all, 0, 10);
	   return $all;
	}
	
	
}
