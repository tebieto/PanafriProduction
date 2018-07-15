<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	
  public $with = ['seller', 'location'];
  protected $fillable = [ 'seller', 'location_id', 'online', 'name' ];
	
	
  	 public function seller()
	{
			return $this->belongsTo('App\User', 'seller');
		
	}
	
	public function location()
	{
			return $this->belongsTo('App\Location', 'location_id');
		
	}
	
}
