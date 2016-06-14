<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class Course extends Model
{
    //
    //
    public function owner()
    {
    	return $this->belongsTo('App\Model\User', 'user_id');
    }
    
    public function skills()
    {
        return $this->morphToMany('App\Model\Skill', 'skillable')->withTimestamps();
    }

    public function videos()
    {
    	return $this->hasMany('App\Model\Video', 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Model\User');
    }

    public function isOwner(User $user)
    {
        return $this->owner->id == $user->id ? true : false ;
    }

    public function posts()
    {
        return $this->morphMany('App\Model\Post', 'postable');
    }

    public function category()
    {
        return $this->belongsTo('App\Modle\Category');
    }
}
