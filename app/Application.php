<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $fillable =[
        'player_name',
        'status',
        'group_id',
        'body',
        'leader_name'
    ];

    public function group(){
        return $this->belongsTo('App\Group', 'group_id', 'group_ID');
    }
    public function showStatus(){

        switch ($this->status){
            case -1:
                return 'Rejected';
            case 0:
                return 'No answer';
            case 1:
                return 'Accepted for tests';
        }
        return 'Accepted';
    }


}
