<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topic_user extends Model
{
    protected $fillable = [
      'transaction_id',
      'status',
      'amount',
    ];
}
