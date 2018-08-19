<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
	use Searchable;
    protected $fillable = ['name', 'owner', 'type', 'price', 'category', 'image', 'status','location', 'description'];
}
