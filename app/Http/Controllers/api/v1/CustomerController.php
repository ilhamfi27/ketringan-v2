<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\MembershipRequest;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
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

        $id_konsumen = $user->customer()->first()->Id_Konsumen;

        $membership_req = new MembershipRequest();
        $membership_req->Id_Konsumen        = $id_konsumen;
        $membership_req->No_Telfon          = $input['No_Telfon'];
        $membership_req->Alamat             = $input['Alamat'];
        $membership_req->Catatan            = $input['Catatan'];

        $data_saved = $membership_req->save();

        if (!$data_saved) {
            return response()->json([
                'error' => 'true',
                'message' => 'Internal Server Error',
            ], 500);
        }

        return response()->json([
            'error' => 'false',
        ], 400);
    }
    
    public function get_activated_membership(Request $request)
    {
        $activated_membership = Customer::where('Membership', 'VIP')->get();

        return response()->json([
            'error' => 'false',
            'data' => $activated_membership,
        ], 200);
    }

    public function get_membership_request(Request $request)
    {
        $user = Auth::user();
        $id_konsumen = $user->customer()->first()->Id_Konsumen;
        $membership_request = MembershipRequest::where('Id_Konsumen', $id_konsumen)->get();

        return response()->json([
            'success' => TRUE,
            'data' => $membership_request,
        ], 200);
    }

    public function profile()
    {
        $user = Auth::user();
        $customerData = $user->konsumen->first();

        return response()->json([
            'success' => TRUE,
            'data' => $customerData,
        ], 200);
    }
}
