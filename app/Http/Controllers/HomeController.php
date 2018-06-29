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
		
		return view('welcome');
		
	}
        return view('home');
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
	
	 public function Products()
    {
	  $all= array();
      
		
	   $products = Product::get();
	   
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
	
	public function removeProduct($pid)
    {
	$product = Store::where('seller', Auth::id())
		->where('product', $pid)
		->first();
		
		if(!empty($product)) {
		
		$product->delete();
		
		}
		
	}
	
	public function authStore()
    {
	  
	  $stores = Store::where('seller', auth::id())->get();
	  
	  $all = array();
	  
	   foreach ($stores as $store):
	   
	   $product = Product::where('id', $store->product)->first();
	   array_push($all, $product);
	   
	   endforeach;
	   
	   return $all;
    }
	
	
	public function submitProduct(Request $request)
    {

	  $add = Product::create([
			
			'name' => $request->name,
			'category_id' => $request->category,
			'image' => $request->image,
		]);
		
		return $request->image;
		
    }
	
	
	public function submitSeller(Request $request)
    {
	  $user = User::where('email', $request->email)->first()
	  ->update([
			
			'status' => 5,
			'avatar' => $request->image,
		]);
		
	 $referral= Referral::create([
			
			'email' => $request->admin,
			
		]);
		
		return $user;
		
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
