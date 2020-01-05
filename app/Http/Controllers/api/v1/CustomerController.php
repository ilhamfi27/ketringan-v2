<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Http\Controllers\Traits\ImageUpload;
use App\MembershipRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    use ImageUpload;
    
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
            ], 400);
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
                'message' => 'Internal Server Error',
            ], 500);
        }

        return response()->json([
            'message' => 'Membership Created!',
        ], 200);
    }
    
    public function get_activated_membership(Request $request)
    {
        $activated_membership = Customer::where('Membership', 'VIP')->get();

        return response()->json([
            'data' => $activated_membership,
        ], 200);
    }

    public function get_membership_request(Request $request)
    {
        $user = Auth::user();
        $id_konsumen = $user->customer()->first()->Id_Konsumen;
        $membership_request = MembershipRequest::where('Id_Konsumen', $id_konsumen)->get();

        return response()->json([
            'data' => $membership_request,
        ], 200);
    }

    public function profile()
    {
        $user = Auth::user();
        $customerData = $user->customer()->first();

        return response()->json([
            'data' => $customerData,
        ], 200);
    }

    public function profileEdit(Request $request)
    {
        $user = Auth::user();
        $customerData = $user->customer()->first();
        $newData = $request->all();

        $userAvatar = $request->Foto_Profil_Konsumen;
        $avatarUrl = $this->userAvatarUpdate($userAvatar);

        DB::beginTransaction();
        try {
            /**
             * Update user credential
             */
            $user->update($request->all());

            /**
             * Update customer credential
             */
            $userAvatar = $request->Foto_Profil_Konsumen;
            $avatarUrl = $this->userAvatarUpdate($userAvatar);

            $newData['Foto_Profil_Konsumen'] = $avatarUrl;
            $customerCredentials = [
                'Email_Konsumen' => $request->email,
                'Password' => Hash::make($request->password),
            ];
            $customerData->update($newData + $customerCredentials);

            DB::commit();

            return response()->json([
                'message' => 'Updated!',
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
        
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }
    }
}
