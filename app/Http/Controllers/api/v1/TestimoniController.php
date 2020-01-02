<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimoni;

class TestimoniController extends Controller
{
    public function active_testimoni(Request $request)
    {
        $testimoni = Testimoni::where('Status_Testimoni', 'enable');

        $testimoni = $request->input('active') == 'false' ? 
                    $testimoni->where('Status_Testimoni', 'disable')->get() : $testimoni->get();

        return response()->json([
            'success' => TRUE,
            'data' => $testimoni
        ], 200);
    }
}
