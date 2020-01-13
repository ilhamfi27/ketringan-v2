<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Region;

class RegionController extends Controller
{
    public function all()
    {
        $region = Region::all();
        return response()->json([
            'data' => $region,
        ], 200);
    }
}
