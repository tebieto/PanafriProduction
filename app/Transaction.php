<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	public $with = ['price', 'tracker'];
  
   protected $fillable = ['price_id', 'quantity', 'tracker_id'];
   
  public function price()
	{
			return $this->belongsTo('App\Price', 'price_id');
		
	}
	
  public function tracker()
	{
			return $this->belongsTo('App\Tracker', 'tracker_id');
		
	}
	
	
	
}
