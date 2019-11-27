<?php

namespace App\Http\Controllers\api\v1;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/banner/active_banner",
     *      description="Get All Active Banner",
     *      @OA\Parameter(
     *          name="active",
     *          in="query",
     *          description="Get Banner with active status true or false, default status is true",
     *          required=false,
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Request OK",
     *      )
     * )
     */
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
}
