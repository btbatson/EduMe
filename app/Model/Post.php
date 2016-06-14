<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    //
    protected $fillable = [
        'content'
    ];
    
    public function user()
    {
    	return $this->belongsTo('App\Model\User', 'user_id');
    }

    public function postable()
    {
    	return $this->morphTo();
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment', 'post_id');
    }

    public function likes()
    {
        return $this->morphMany('App\Model\Like', 'likeable');
    }
}
