<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnbanRequest extends Model
{
    //
    protected $table='panel_unbanrequest';

    protected $fillable=[
        'player_name',
        'status',
        'body'
    ];
    public function comments(){
        return $this->morphMany('App\Comment', 'imageable');
    }
}
