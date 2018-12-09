<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [ 'owner', 'image', 'status', 'name', 'description', 'email', 'phone', 'address', 'state', 'landmark', 'identity' ];
}
