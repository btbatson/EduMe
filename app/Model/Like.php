<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    //
    public function likeable()
    {
    	return $this->morphTo();
    }

    public function user()
    {
    	return $this->belongsTo('App\Model\User', 'user_id');
    }
}
