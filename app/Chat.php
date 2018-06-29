<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
   protected $fillable = ['transaction_id', 'receiver_id', 'sender_id', 'body'];
   
  
}
