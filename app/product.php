<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class product extends Model
{
	use Searchable;
	use Notifiable;

	public $with = ['owner'];
    protected $fillable = ['name', 'owner', 'store', 'type', 'price', 'category', 'image', 'status','location', 'description'];

	public function owner()
	{
			return $this->belongsTo('App\User', 'owner');
		
    }

}
