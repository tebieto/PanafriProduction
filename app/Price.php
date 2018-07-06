<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
     protected $fillable = [ 'price', 'unit', 'product_id' ];
}
