<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    
	protected $fillable = [
        'skill',
    ];

    public function users()
    {
        return $this->morphedByMany('App\Model\User', 'skillable')->withTimestamps();
    }

    public function courses()
    {
        return $this->morphedByMany('App\Model\Course', 'skillable')->withTimestamps();
    }
}
