<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    //
    protected $table = 'experiences';

    public function getDates()
    {
        return [
            'updated_at',
            'created_at',
            'start_date',
            'end_date',
        ];
    }

    public function user()
    {
    	return $this->belongsTo('App\Model\Experience', 'user_id');
    }
}
