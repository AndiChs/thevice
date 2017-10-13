<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $primaryKey='group_id';

    protected $fillable=[
        'questions',
    ];
    public $timestamps = false;

    public function group(){
        return $this->belongsTo('App\Group', 'group_id', 'group_ID');
    }


}
