<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    //
    protected $table = 'educations';

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
    	return $this->belongsTo('App\Model\Education', 'user_id');
    }
}
