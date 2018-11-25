<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['type', 'buyer_id', 'seller_id', 'status', 'delivery', 'location', 'seller_status', 'buyer_status'];
}
