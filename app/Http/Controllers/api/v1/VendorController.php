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
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'No_Telfon' => 'required|numeric',
            'Alamat' => 'required',
            'Catatan' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ], 400);
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
