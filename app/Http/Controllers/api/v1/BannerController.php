<?php

namespace App\Http\Controllers\api\v1;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function active_banner(Request $request)
    {
        $banner = Banner::where('Status', 'Enable');

        $banner = $request->input('active') == 'false' ? 
                    $banner->where('Status', 'Disable')->get() : $banner->get();

        return response()->json([
            'data' => $banner
        ], 200);
    }
}
