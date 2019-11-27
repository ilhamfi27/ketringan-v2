<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimoni;

class TestimoniController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/testimoni/active_testimoni",
     *      description="Get All Active Testimoni",
     *      @OA\Parameter(
     *          name="active",
     *          in="query",
     *          description="Get Testimoni with active status true or false, default status is true",
     *          required=false,
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Request OK",
     *      )
     * )
     */
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
