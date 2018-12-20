<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function matches_home()
    {
        return $this->hasMany('App\Match', 'home_team');
    }

    public function matches_away()
    {
        return $this->hasMany('App\Match', 'away_team');
    }

    public function stadium()
    {
        return $this->belongsTo('App\Stadium');
    }
}
