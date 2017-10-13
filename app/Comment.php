<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=[
        'body',
        'player_name',
        'imageable_id',
        'imageable_type'
    ];
    public function imageable(){

        return $this->morphTo();
    }

}
