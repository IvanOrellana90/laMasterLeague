<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Gstt\Achievements\Achiever;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Achiever;

    public function bets()
    {
        return $this->hasMany('App\Bet');
    }

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function avatar()
    {
        return $this->belongsTo('App\Avatar');
    }

    public function groups()
    {
        return $this->hasMany('App\Group');
    }

    public function groupsBelong()
    {
        return $this->belongsToMany('App\Group','group_user')->withPivot('group_id', 'user_id', 'active')->withTimestamps();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
