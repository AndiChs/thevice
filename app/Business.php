<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
    public function owner(){
        return $this->belongsTo('App\User','ID','player_business');
    }
}
