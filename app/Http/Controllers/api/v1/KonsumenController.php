<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MembershipRequest;
use Illuminate\Support\Facades\Auth;

class KonsumenController extends Controller
{
    public function membership_request(Request $request)
    {

        $user = Auth::user();
        $input = $request->all();


        $validator = Validator::make($request->all(), [
            'No_Telfon' => 'required|numeric',
            'Alamat' => 'required',
            'Catatan' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ], 401);
        }

        $id_konsumen = $user->konsumen()->first()->Id_Konsumen;

        $membership_req = new MembershipRequest();
        $membership_req->Id_Konsumen        = $id_konsumen;
        $membership_req->No_Telfon          = $input['No_Telfon'];
        $membership_req->Alamat             = $input['Alamat'];
        $membership_req->Catatan            = $input['Catatan'];

        $membership_req->save();

        return response()->json([
            'error' => 'false',
        ], 200);

    }
}
