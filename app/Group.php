<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public $timestamps = false;

    protected $primaryKey='group_ID';

    protected $fillable=[
      'group_Applications'
    ];

    public function countMembers(){
        return User::where('player_team', '=', $this->group_ID)->count();
    }
}
