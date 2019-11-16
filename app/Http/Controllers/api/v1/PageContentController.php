<?php

namespace App\Http\Controllers\api\v1;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimoni;

class PageContentController extends Controller
{
    public function active_banner(Request $request)
    {
        $banner = Banner::where('Status', 'Enable');

        $banner = $request->input('active') == 'false' ? 
                    $banner->where('Status', 'Disable')->get() : $banner->get();

        return response()->json([
            'error' => 'false',
            'data' => $banner
        ], 200);
    }

    public function active_testimoni(Request $request)
    {
        $testimoni = Testimoni::where('Status_Testimoni', 'enable');

        $testimoni = $request->input('active') == 'false' ? 
                    $testimoni->where('Status_Testimoni', 'disable')->get() : $testimoni->get();

        return response()->json([
            'error' => 'false',
            'data' => $testimoni
        ], 200);
    }
}
