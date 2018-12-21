<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $fillable = ['user_id', 'match_id', 'home_score', 'away_score'];

    public function match()
    {
        return $this->belongsTo('App\Match');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
