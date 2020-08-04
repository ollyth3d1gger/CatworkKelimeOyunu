<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    protected $fillable = [
         'topic_id', 'user_id', 'points'
    ];

}
