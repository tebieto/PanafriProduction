<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppRequest extends Model
{
    public $with = ['buyer', 'seller', 'product'];
    protected $fillable = ['type', 'product_id', 'buyer_id', 'seller_id', 'status', 'delivery', 'location', 'seller_status', 'buyer_status'];

    public function buyer()
	{
			return $this->belongsTo('App\User', 'buyer_id');
		
    }
    
    public function seller()
	{
			return $this->belongsTo('App\User', 'seller_id');
		
    }
    
    public function product()
	{
			return $this->belongsTo('App\Product', 'product_id');
		
	}

}

