<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	
   public $with = ['chats'];
   protected $fillable = ['product_id', 'seller_id', 'buyer_id', 'status', 'type'];
   
   public function chats()
	{
			return $this->hasMany('App\Chat', 'transaction_id');
		
	}
	
	
	
}
