<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Http\Controllers\Traits\ImageUpload;
use App\MembershipRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\QuickOrder;

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
        $membersRequests = MembershipRequest::where('Id_Konsumen', $id_konsumen)
                                ->select('Status_Request', 'created_at')
                                ->get()->toArray();
        $membersRequests[0]['kategori_status'] = 'Membership';
        $quickOrders = QuickOrder::where('Id_Konsumen', $id_konsumen)
                                ->select('Status', 'created_at')
                                ->get()->toArray();
        foreach ($quickOrders as $key => $value) {
            $quickOrders[$key]['kategori_status'] = 'Negoisasi';
            array_push($membersRequests, $quickOrders[$key]);
        }

        return response()->json([
            'data' => $membersRequests,
        ], 200);
    }

    public function profile()
    {
        $user = Auth::user();
        $customerData = $user->customer()->first();
        $customerData->is_verifed = $customerData->is_verifed == 1 
                                        ? true : false;
        return response()->json([
            'data' => $customerData,
        ], 200);
    }

    public function profileEdit(Request $request)
    {
        $user = Auth::user();
        $customerData = $user->customer()->first();
        $newData = $request->all();
        
        $validator = Validator::make($request->all(), [
            'Nama_Konsumen' => 'required|regex:/^[a-zA-Z ]*$/',
            'No_Telfon_Konsumen' => 'required|numeric',
            'Alamat_Konsumen' => 'required',
            'Foto_Profil_Konsumen' => '',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        DB::beginTransaction();
        try {
            /**
             * Update customer credential
             */
            $userAvatar = $request->Foto_Profil_Konsumen;
            $avatarUrl = $request->Foto_Profil_Konsumen != null ?
                             $this->userAvatarUpdate($userAvatar) : null;

            $newData['Foto_Profil_Konsumen'] = $avatarUrl;

            if ($avatarUrl == null) {
                unset($newData['Foto_Profil_Konsumen']);
            }
            
            $customerData->update($newData);

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

    public function orderList()
    {
        $user = Auth::user();
        $customer = $user->customer()->first();
        $orders = $customer->orders()->get()->toArray();

        foreach ($orders as $key => $value) {
            $orders[$key]['Status_Pesanan'] = ucwords(
                str_replace("_", " ", $orders[$key]['Status_Pesanan']));
        }

        return response()->json([
            'data' => $orders,
        ], 200);
    }
}
