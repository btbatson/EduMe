<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    //
    public function courses()
    {
    	return $this->hasMany('App\Model\Course');
    }
}
