<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ban extends Model
{
    //
    protected $table='player_bans';

    public function bannedUntil(){

        $eventName = 'unban_'.$this->player_name;
        $ban = DB::table('INFORMATION_SCHEMA.events')
            ->where('EVENT_NAME', '=', $eventName)
            ->limit(1)
            ->get();
        if(count($ban)){
            return $ban[0]->EXECUTE_AT;
        }
        return 'Never';
    }
}
