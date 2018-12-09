<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class product extends Model
{
	use Notifiable;


    protected $fillable = ['name', 'owner', 'store', 'type', 'price', 'category', 'image', 'status','location', 'description', 'quantity'];

	

}
