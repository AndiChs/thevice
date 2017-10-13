<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    //
    protected $primaryKey='clan_ID';

    public function countMembers(){
        return User::where('player_clan', '=', $this->clan_ID)->count();
    }
}
