<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\User;
use App\category;
use App\product;
use App\Transaction;
use App\Chat;
use App\referral;
use App\Store;
use App\Location;
use App\Price;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
	if(!Auth::check()){
		
		return view('app');
		
	}
        return view('app');
    }
	
	 public function sellerLogout()
    {
      Auth::logout();
      return redirect()->intended('login/seller/login');
    }
	
	 public function allLogout()
    {
      Auth::logout();
      return redirect()->intended('/app');
    }
	
	
	
	
	public function editProfile(Request $r)
	{
	
 $this->validate($r, [
 
		'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|',
		'phone' => 'required|string|max:11|',
		
	]);	
	
	$update= User::where('id', auth::id())->first()		
	->update([
		'name' => $r->name,
		'email'=> $r->email,
		'phone'=>$r->phone,
		]);
		
	$avatar= $r->avatar;
	if(!empty($avatar)) {
		
	$update= User::where('id', auth::id())->first()		
	->update([
		'avatar' => $r->avatar,
		]);	
		
	}
		//Session::flash('success', 'Upload edited successfully.');
	    return redirect()->back();
		
	}
	
	
	public function changePassword(Request $r)
	
	{
	
	$this->validate($r, [
 
	'password' => 'required|string|min:6|confirmed',		
		
	]);	
	
	$update= User::where('id', auth::id())->first()		
	->update([
		
		'password' => bcrypt($r->password),
		
		]);
	
		//Session::flash('success', 'Upload edited successfully.');
	   Auth::logout(); 
	   return redirect()->back();
		
	}
	
	
	 public function Categories()
    {
	  $all= array();
      
		
	   $categories = Category::get();
	   
	   foreach ($categories as $category):
	   array_push($all, $category);
	   
	   endforeach;
	   
	   return $all;
    }
	
	
	public function services()
    {
	  $all= array();
      
		
	   $products = Product::where('type', 2)->orderBy(DB::raw('RAND()'))->get();
	   
	   foreach ($products as $product):
	   array_push($all, $product);
	   
	   endforeach;
	   $all= array_slice($all, 0, 10);
	   return $all;
    }
	
	 public function products()
    {
	  $all= array();
      
		
	   $products = Product::where('type', 1)->orderBy(DB::raw('RAND()'))->get();
	   
	   foreach ($products as $product):
	   array_push($all, $product);
	   
	   endforeach;
	    $all= array_slice($all, 0, 10);
	   return $all;
    }
	
	
	public function authProducts()
    {
	  $all= array();
      
		
	   $products = Product::where('type', 1)->where('owner', auth::id())->get();
	   
	   foreach ($products as $product):
	   array_push($all, $product);
	   
	   endforeach;
	  
	   return $all;
    }
	
public function authServices()
    {
	  $all= array();
      
		
	   $products = Product::where('type', 2)->where('owner', auth::id())->get();
	   
	   foreach ($products as $product):
	   array_push($all, $product);
	   
	   endforeach;
	   
	   return $all;
    }
	
	 public function saveCategory($name)
    {
	  $all= array();
	  
      $add = Category::create([
			
			'name' => $name
		]);
		
	  $categories = Category::get();
	   
	   foreach ($categories as $category):
	   array_push($all, $category);
	   
	   endforeach;
	   
	   return $all;
    }
	
	
	public function findSellers($pid, $cid)
    {
		 $stored = Store::where('product', $pid)->get();
		if (!$stored) {
			
		return 0;	
			
		}
		 $sellers = array();
		 
		 foreach ($stored as $store):
		 
		 $seller = User::where('id', $store->seller)->first();
		 
		 array_push($sellers, $seller);
		
		 endforeach;
		 
		 return $sellers;
	}
	
	public function activeProduct($pid)
    {
		
		$product = Product::where('id', $pid)->first();
		return $product;
		
	}
	
	public function onProduct($pid)
    {
		
		$product = Product::where('id', $pid)->first();
		
		if($product->status==1) {
		return 0;
		}
		
		$product = Product::where('id', $pid)->first()
	  ->update([
			
			'status' => 1,
		
		]);
		
	}
	
	public function offProduct($pid)
    {
		
		$product = Product::where('id', $pid)->first();
		
		if($product->status==0) {
		return 0;
		}
		
		$product = Product::where('id', $pid)->first()
	  ->update([
			
			'status' => 0,
		
		]);
		
	}
	
	public function onStore($sid)
    {
		
		$store = Store::where('id', $sid)->first();
		
		if($store->online==1) {
		return 0;
		}
		
		$store = Store::where('id', $sid)->first()
	  ->update([
			
			'online' => 1,
		
		]);
		
	}
	
	public function offStore($sid)
    {
		
		$store = Store::where('id', $sid)->first();
		
		if($store->online==0) {
		return 0;
		}
		
		$store = Store::where('id', $sid)->first()
	  ->update([
			
			'online' => 0,
		
		]);
		
	}
	
	
	public function onApp()
    {
		
		$app = User::where('id', auth::id())->first();
		
		if($app->online==1) {
		return 0;
		}
		
		$app = User::where('id', auth::id())->first()
	  ->update([
			
			'online' => 1,
		
		]);
		
		
		
	}
	
	public function offApp()
    {
		
		$app = User::where('id', auth::id())->first();
		
		if($app->online==0) {
		return 0;
		}
		
		$app = User::where('id', auth::id())->first()
	  ->update([
			
			'online' => 0,
		
		]);
		
	}
	
	
	
	 public function sellProduct($cid, $pid)
    {
	  
	  $seller = User::where('id', auth::id())->where('status', 5)->first();
	  
	  if(!$seller) {
		  
		return 0;  
		  
	  }
	  
	   $more = array();
		
	  $others = Product::where('category_id', $cid)->get();
	   
	   foreach ($others as $other):
	   array_push($more, $other);
	   
	   endforeach;
	   
	   
	   
	  
	   $stored = Store::where('seller', auth::id())->where('product', $pid)->first();
	  
	  if(count($stored)) {
		  
		return $more;  
		  
	  }
	  
	  
	  
      $store = Store::create([
			
			'seller' => auth::id(),
			'product' => $pid
		]);
		
		return $more;
		
    }
	
	public function checkStore($pid)
    {
	  
	  $check = Store::where('seller', auth::id())->where('product', $pid)->first();
	  if($check) {
		
		return 1;
		  
	  }
	  
	  else {
		return 0;  
		  
	  }
	  
	}
	
	
	public function authDetails()
    {
	$auth = User::where('id', Auth::id())->first();
	
	return $auth;
	
	}
	
	public function adminDeleteProduct($pid)
    {
		
	if(auth::user()->role<2) {
	return;	
	}
	$product = Product::where('id', $pid)
		->first();
		
		if(!empty($product)) {
		
		$product->delete();
		
		}
		
	}
	
	public function authDeleteProduct($pid)
    {
	
	$product = Product::where('id', $pid)->where('owner', auth::id())
		->first();
		
		if(!empty($product)) {
		
		$product->delete();
		
		}
		
	}
	
	
	public function adminDeleteCategory($cid)
    {
		
	if(auth::user()->role<2) {
	return;	
	}
	$category = Category::where('id', $cid)
		->first();
		
		if(!empty($category)) {
		
		$category->delete();
		
		}
		
	}
	
	
	public function removeProduct($pid)
    {
	$product = Store::where('seller', Auth::id())
		->where('product', $pid)
		->first();
		
		if(!empty($product)) {
		
		$product->delete();
		
		}
		
	}
	
	
	public function removePrices($pid)
    {
	$price = Price::where('id', $pid)
		->first();
		
	if(!empty($price)) {
		
		$price->delete();
		
		return 1;
		
		}
		
		return 0;
		
	}
	
	
	public function getPrices($pid)
    {
	$prices = Price::where('product_id', $pid)
		->get();
		
	$all= array();
	
	 foreach ($prices as $price):
		 
		 
		 array_push($all, $price);
		
	  endforeach;
	
	return $all;
	}
	
	public function allShops($start)
    {
	return 1;	
	$shops = Store::orderBy('created_at', 'DESC')->skip($start)->take(8)->get();
	$all = array();
	
	 foreach ($shops as $shop):
		 
		 
		 array_push($all, $shop);
		
	 endforeach;
	
	return $all;
	
		
	}
	
	
	public function getStoreProducts($sid)
    {
	$products = Product::where('store_id', $sid)->orderBy('created_at', 'DESC')
		->get();
		
	$all= array();
	
	 foreach ($products as $product):
		 
		 
		 array_push($all, $product);
		
	  endforeach;
	
	return $all;
	}

	
	public function userDetails($id)
    {
	$user = User::where('id', $id)
		->first();
	
	return $user;
	}
	
	
	public function authShops()
    {
	  
	  $shops = Store::where('seller', auth::id())->orderBy('created_at', 'DESC')->get();
	  
	  $all = array();
	  
	   foreach ($shops as $shop):
	   
	   array_push($all, $shop);
	   
	   endforeach;
	   
	   return $all;
    }
	
	
	public function submitProduct(Request $request)
    {

	  $add = Product::create([
			'owner' => auth::id(),
			'name' => $request->name,
			'type' => $request->type,
			'category' => $request->category,
			'image' => $request->image,
			'status' => 1,
			'description' => $request->description,
			'location' => $request->location,
			'price' => $request->price,
		]);
		
		return 1;
		
    }
	
	
	public function submitCat(Request $request)
    {

	  $add = Category::create([

			'name' => $request->name,
			'type' => $request->type,
			'image' => $request->image,
			
		]);
		
		return 1;
		
    }
	
	public function sendPrice(Request $request)
    {

	  $add = Price::create([
			
			'price' => $request->price,
			'product_id' => $request->product_id,
			'unit' => $request->unit,
		]);
		
		return 1;
		
    }
	
	
	public function saveShop(Request $request)
    {
		
	  $location = Location::create([
			
			'location' => $request->location,
			'user_id' => auth::id(),
		]);

	  $add = Store::create([
			
			'name' => $request->name,
			'location_id' => $location->id,
			'seller' =>auth::id(),
			'online' => 1,
		]);
		
		return 1;
		
    }
	
	
	public function submitSeller(Request $request)
    {
	  $user = User::where('email', $request->email)->first()
	  ->update([
			
			'status' => 5,
			'avatar' => $request->image,
		]);
		
	 $referral= referral::create([
			
			'email' => $request->admin,
			
		]);
		
		return 1;
		
    }
	
	public function createTransaction($sid, $pid, $cid) {
		
	 $transaction = Transaction::create([
			
			'buyer_id' => auth::id(),
			'product_id' => $pid,
			'seller_id' => $sid,
			'status' => 0,
			'type' => $cid,
		]);	
		
		return $transaction;
		
	}
	
	public function declineTransaction($tid) {
		
	$transaction = Transaction::where('id', $tid)->first()
	  ->update([
			
			'status' => 1,
			
		]);	
		
		
		
	}
	
	public function openTransactions() {
		$all = array();
		$transactions = Transaction::where('status', 0)->Where('seller_id', auth::id())
		->orWhere('buyer_id', auth::id())->where('status', 0)->get();
		
		foreach ($transactions as $transaction):
	   
	   array_push($all, $transaction);
	   
	   endforeach;
	   
	   return $all;
		
	}
	
	
	public function closedTransactions() {
		
		$all = array();
		$transactions = Transaction::where('status', 1)->Where('seller_id', auth::id())
		->orWhere('buyer_id', auth::id())->where('status', 1)->get();
		
		foreach ($transactions as $transaction):
	   
	   array_push($all, $transaction);
	   
	   endforeach;
	   
	   return $all;
		
		
		
	}
	
	
	public function getChat($tid) {
	 $all = array();
	 $chats = Chat::where('transaction_id',$tid)->get();
		
		foreach ($chats as $chat):
		
	   array_push($all, $chat);
	   
	   endforeach;
	   
	   return $all;
		
	}
	
	public function sendChat(Request $request) {
	
	$transaction = Transaction::where('id', $request->transaction)->first();
	
	if (($transaction->seller_id == auth::id()) || ($transaction->buyer_id == auth::id())) {
		
		 $chat = Chat::create([
			
			'sender_id' => auth::id(),
			'receiver_id' => $request->receiver,
			'transaction_id' => $request->transaction,
			'body' => $request->body,
		]);
		
		
		
	} else {
		
		return 0;
		
		
		
	}
		
		
		
	}
	
	
	public function image(Request $request)
	{
		
		// This class process an uploaded image and returns a valid URL
		
		
		$image= $request->img;
		
		
		
		$ext = $image->extension();
		
		
		if ($ext== 'jpg' || $ext== 'jpeg' || $ext == 'png' || $ext == 'gif') {
			$type = 'image';
			
			//  we save the image in image folder
			
			$link = $image->store('public/images');
		} else {
			
			// If the user mistakenly upload a video instead of an image we save the video in video folder
			$type = 'video';
			$link = $image->store('public/videos');
		}
		
		if ($ext!= 'jpg' && $ext!= 'jpeg' && $ext != 'png' && $ext != 'gif' && $ext != '3gp' && $ext != 'ogg' && $ext != 'mp4' && $ext != 'webm' && $ext != 'avi' && $ext != 'flv' && $ext != 'wmv' && $ext != 'mov' ) {
			// If file format is not acceptable, we delete the file
			
			Storage::delete($link);
			
			// we return false instead of a valid URL
			
			return 0;
			
		}
		
	// If every thing goes well, we return a valid URL.
	
	return response(['URL'=>asset(Storage::url($link)), 'link'=>$link, 'type' => $type, 'ext' => $ext, 'mime' => $type .'/'. $ext]);
		
		
	}
	
	
}
