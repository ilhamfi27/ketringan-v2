<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PartnershipRequest;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function partnership_request(Request $request)
    {
        /**
         * @OA\Post(
         *      path="/api/v1/vendor/partnership_request",
         *      description="Request partnership for vendor",
         *      @OA\Parameter(
         *          name="No_Telfon",
         *          in="query",
         *          description="User's phone number",
         *          required=true,
         *      ),
         *      @OA\Parameter(
         *          name="Alamat",
         *          in="query",
         *          description="User's address",
         *          required=true,
         *      ),
         *      @OA\Parameter(
         *          name="Catatan",
         *          in="query",
         *          description="User's note",
         *          required=true,
         *      ),
         *      @OA\Response(
         *          response="200", 
         *          description="Request OK",
         *      ),
         *      @OA\Response(
         *          response="401", 
         *          description="Validation error",
         *      )
         * )
         */
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'No_Telfon' => 'required|numeric',
            'Alamat' => 'required',
            'Catatan' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => FALSE,
                'error' => $validator->errors()
            ], 401);
        }

        $parnership_req = new PartnershipRequest();
        $parnership_req->No_Telfon = $input['No_Telfon'];
        $parnership_req->Alamat = $input['Alamat'];
        $parnership_req->Catatan = $input['Catatan'];

        $data_saved = $parnership_req->save();

        if (!$data_saved) {
            return response()->json([
                'success' => FALSE,
                'message' => 'Internal Server Error',
            ], 500);
        }

        return response()->json([
            'success' => TRUE,
        ], 200);
    }
}
