<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    //
    public function chat()
    {
        return $this->belongsTo('App\Model\Chat');
    }

    public function sender()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }
}
