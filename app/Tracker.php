<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
	
	public $with = ['chats'];
    protected $fillable = ['location', 'seller_id', 'buyer_id', 'shop_id', 'status', 'delivery', 'seller_status', 'buyer_status'];
	
	 public function chats()
	{
			return $this->hasMany('App\Chat', 'tracker_id');
		
	}
	
}
