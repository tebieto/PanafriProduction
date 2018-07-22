<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
	 public $with = ['product'];
     protected $fillable = [ 'price', 'unit', 'product_id' ];

	 public function product()
	{
			return $this->belongsTo('App\product', 'product_id');
		
	}
	 
}
