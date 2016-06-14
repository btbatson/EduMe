<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    //
    public function course()
    {
    	return $this->belongsTo('App\Model\Course', 'course_id');
    }
}
