<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function errorMissingAttribute()
    {
        return response()->json([
            'success' => 'false',
            'message' => 'missing attribute(s).'
            ], 200);
    }

    public function returnTrue()
    {
    	return response()->json([
            'success' => 'true',
            ], 200);
    }
}
