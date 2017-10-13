<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable=[
        'player_name',
        'status',
        'type',
        'body'
    ];

    public function getType(){
        $ticketTypes = [
            '0'=>'General ticket',
            '1'=>'Problems with the account',
            '2'=>'Problems with a payment',
        ];
        return $ticketTypes[$this->type];
    }

    public function comments(){

        return $this->morphMany('App\Comment', 'imageable');
    }
}
