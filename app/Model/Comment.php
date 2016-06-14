<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'content'
    ];

    public function post()
    {
    	return $this->belongsTo('App\Model\Post', 'post_id');
    }
    public function user()
    {
    	return $this->belongsTo('App\Model\User', 'user_id');
    }

    public function likes()
    {
        return $this->morphMany('App\Model\Like', 'likeable');
    }
}
