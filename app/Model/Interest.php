<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    //
    //
    public function users()
    {
        return $this->belongsToMany('App\Model\User');
    }
}
