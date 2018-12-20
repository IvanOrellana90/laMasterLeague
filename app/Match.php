<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function tournament()
    {
        return $this->belongsTo('App\Tournament');
    }

    public function homeTeam()
    {
        return $this->belongsTo('App\Team', 'home_team');
    }

    public function awayTeam()
    {
        return $this->belongsTo('App\Team', 'away_team');
    }

    public function stadium()
    {
        return $this->belongsTo('App\Stadium');
    }
}
