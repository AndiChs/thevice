<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'players';

    protected $primaryKey = 'player_id';

    protected $fillable = [
        'player_name', 'player_password',
    ];

    public $timestamps=false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'player_password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function linkToProfile(){
        return '<a href='.route('home.profile', htmlspecialchars($this->player_name)).'>'.htmlspecialchars($this->player_name).'</a>';
    }

    public function group(){
        return $this->belongsTo('App\Group','player_team','group_id');
    }

    public function clan(){
        return $this->belongsTo('App\Clan','player_clan','clan_id');
    }
    public function cars(){
        return $this->hasMany('App\Car','player_id');
    }

    public function showStatus(){
        return $this->player_in_game_id == -1 ? '<span class="badge badge-danger badge-roundless">Offline</span>' : '<span class="badge badge-success badge-roundless">Online</span>';
    }

    public function showSkin($height = null){
        return '<img src="https://panel.thevice.ro/assets/images/skins/Skin_'.$this->player_skin.'.png" style="height:'. ($height == null ? 'auto' : $height.'px') .';max-width:100%;">';
    }

    public function showProfilePicture(){
        return '<img src="https://panel.thevice.ro/assets/images/profile/'.$this->player_skin.'.png" class="small-profile-picture">';
    }
    public function isAdmin(){
        return $this->player_admin > 0;
    }
    public function isTeamLeader(){
        return $this->player_team_rank == 7;
    }
    public function notifications(){
        return $this->hasMany('App\Notification','player_id');
    }
}
