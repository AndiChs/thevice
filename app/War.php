<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class War extends Model
{
    //
    protected $table='log_wars';


    public function groupAttacker(){
        return $this->belongsTo('App\Group', 'attacker_id', 'group_ID');
    }
    public function groupDefender(){
        return $this->belongsTo('App\Group', 'defender_id', 'group_ID');
    }
}
