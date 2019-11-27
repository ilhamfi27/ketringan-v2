<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Konsumen;
use App\MembershipRequest;
use Illuminate\Support\Facades\Auth;

class KonsumenController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/v1/konsumen/request_membership",
     *      description="Request membership for konsumen",
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
     *      ),
     *      security={
     *          {"Bearer":{}}
     *      }
     * )
     */
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

        $data_saved = $membership_req->save();

        if (!$data_saved) {
            return response()->json([
                'error' => 'true',
                'message' => 'Internal Server Error',
            ], 500);
        }

        return response()->json([
            'error' => 'false',
        ], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/konsumen/activated_membership",
     *      description="Get activated membership for konsumen",
     *      @OA\Response(
     *          response="200", 
     *          description="Request OK",
     *      )
     * )
     */
    public function get_activated_membership(Request $request)
    {
        $activated_membership = Konsumen::where('Membership', 'VIP')->get();

        return response()->json([
            'error' => 'false',
            'data' => $activated_membership,
        ], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/konsumen/get_membership_request",
     *      description="Get membership request",
     *      @OA\Response(
     *          response="200", 
     *          description="Request OK",
     *      ),
     *      security={
     *          {"Bearer":{}}
     *      }
     * )
     */
    public function get_membership_request(Request $request)
    {
        $user = Auth::user();
        $id_konsumen = $user->konsumen()->first()->Id_Konsumen;
        $membership_request = MembershipRequest::where('Id_Konsumen', $id_konsumen)->get();

        return response()->json([
            'error' => 'false',
            'data' => $membership_request,
        ], 200);
    }
}
