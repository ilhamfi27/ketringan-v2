<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\RegistrationConfirmation;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function login()
    {
        $user_data = [
            'email' => request('email'),
            'password' => request('password'),
        ];

        if(Auth::attempt($user_data)){
            $user = Auth::user();
            $namaKonsumen = $user->customer()->first()->Nama_Konsumen;
            $response['token'] = $user->createToken('userLogin')->accessToken;
            $response['Nama_Konsumen'] = $namaKonsumen;
            $response['email'] = $user->email;
            $response['is_verifed'] = $user->email_verified_at != null ? true : false;
            return response()->json(
                $response
            , 200);
        } else {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|unique:users',
            'no_telefon' => 'required|numeric',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        /**
         * generate token untuk konfirmasi email
         */
        $generated_token = hash('sha256', str_random(40).$input['email']);
        $input['verification_token'] = $generated_token;

        /**
         * insert data ke table users
         */
        $user = User::create($input);
        
        /**
         * token untuk login aplikasi
         */
        $success['token'] = $user->createToken('userRegister')->accessToken;

        /**
         * insert data ke tabel tb_konsumen
         */
        $konsumen = new Customer();
        $konsumen->Nama_Konsumen = $input['nama'];
        $konsumen->No_Telfon_Konsumen = $input['no_telefon'];
        $konsumen->Email_Konsumen = $input['email'];
        $konsumen->Password = $input['password'];
        $konsumen->user_id = $user->id;
        $konsumen->save();

        $success['Nama_Konsumen'] = $konsumen->Nama_Konsumen;
        $success['Email_Konsumen'] = $user->email; // pakai email dari tabel users

        /**
         * Mail sender untuk mengirimkan token konfirmasi
         * ke email user
         */
        $must_confirm = (object) [
            'nama' => $konsumen->Nama_Konsumen,
            'url' => env('APP_URL') 
                    . '/api/v1/token_confirmation/'. $user->id 
                    . '?token=' . $generated_token,
        ];
        Mail::to($user)->send(new RegistrationConfirmation($must_confirm));
        
        if (count(Mail::failures()) > 0) {
            return response()->json([
                "error" => "Mail not successfully sent!",
            ], 500);
        }
        
        /**
         * $success untuk nilai balikan register()
         * 
         * $success['token'] -> token
         * $success['nama_konsumen'] -> nama konsumen
         * $success['email_konsumen'] -> email konsumen
         */

        return response()->json($success, 200);
    }
    
    public function token_confirmation(Request $request)
    {
        $user = User::find($request->route('id'));
        $token = $request->input('token');

        if(isset($user->email_verified_at)) {
            return response()->json([
                'message' => 'Your email has been verified!',
            ], 200);
        }

        if($user->verification_token == $token && !isset($user->email_verified_at)){
            $user->email_verified_at = Carbon::now()->timestamp;
            $user->save();
        }

        if ($user->verification_token != $token) {
            return response()->json([
                'message' => 'Invalid verification token!',
            ], 401);
        }

        return response()->json([
            'message' => 'Verification success!',
        ], 200);
    }
    
    public function details()
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user
        ], 200);
    }

    public function updateCredentials(Request $request)
    {
        $user = Auth::user();
        $customerData = $user->customer()->first();

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);
        
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'error' => [
                    'old_password' => [
                        'Password Lama Salah'
                    ]
                ],
            ], 400);
        }

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        DB::beginTransaction();
        try {
            $newPassword = Hash::make($request->password);
            /**
             * Update customer credential
             */
            $customerCredentials = [
                'Password' => $newPassword,
            ];
            $customerData->update($customerCredentials);

            /**
             * Update customer credential
             */
            $user->update([
                'password' => $newPassword,
            ]);

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
