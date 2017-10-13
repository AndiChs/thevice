<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable =[
        'player_id',
        'body',
        'url',
        'seen'
    ];
}
