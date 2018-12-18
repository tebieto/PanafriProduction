<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $fillable = [ 'partner_id', 'user_id', 'message', 'name', 'avatar', 'rating', 'status' ];
}
