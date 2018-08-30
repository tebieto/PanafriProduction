<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendingTransactions extends Model
{	
	public $with = ['product'];
    protected $fillable = ['product_id', 'seller_id', 'buyer_id', 'seller_status', 'buyer_status'];
	
	public function product()
	{
			return $this->belongsTo('App\product', 'product_id');
		
	}
	
}
