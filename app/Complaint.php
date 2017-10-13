<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    //
    protected $fillable=[
        'player_name',
        'complainant_name',
        'admin_name',
        'type',
        'status',
        'proofs',
        'body',
        'action',
        'action_amount',
        'action_reason',
        'faction_id'
    ];

    public function comments(){
        return $this->morphMany('App\Comment', 'imageable');
    }

    public function getType(){
        $complaintTypes = [
            '0'=>'Deathmatch / drive-by',
            '1'=>'Offensive language / insults / dirty words',
            '2'=>'Scam / Scam attempt',
            '3'=>'Other (abuz, comportament non-rp)',
            '4'=>'Faction mistake',
            '5'=>'Admin abuse/mistake',
            '6'=>'Helper abuse/mistake',
            '7'=>'Leader abuse/mistake'
        ];
        return $complaintTypes[$this->type];
    }
}
