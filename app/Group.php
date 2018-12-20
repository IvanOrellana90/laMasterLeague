<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User','group_user')->withPivot('group_id', 'user_id', 'active')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tournament()
    {
        return $this->belongsTo('App\Tournament');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
