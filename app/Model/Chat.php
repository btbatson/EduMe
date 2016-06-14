<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    //
    public function messages()
    {
        return $this->hasMany('App\Model\Message');
    }

    public function sender()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    public function reciver()
    {
        return $this->belongsTo('App\Model\User', 'friend_id');
    }

    public function users()
    {
        return $this->sender()->get()
                ->merge($this->reciver()->get());
    }
}
