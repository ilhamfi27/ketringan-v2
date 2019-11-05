<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Konsumen;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *      path="/login",
     *      description="API for Login, the login will be generate token that must used by all pages that require authentication",
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          description="User's email",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          in="query",
     *          description="User's password",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="OK",
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized"
     *      )
     * )
     */
    public function login()
    {
        $user_data = [
            'email' => request('email'),
            'password' => request('password'),
        ];

        if(Auth::attempt($user_data)){
            $user = Auth::user();
            $success['token'] = $user->createToken('userLogin')->accessToken;
            return response()->json([
                'success' => $success
            ], 200);
        } else {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }
    }

    /**
     * @OA\Post(
     *      path="/register",
     *      description="API for Login, the login will be generate token that must used by all pages that require authentication",
     *      @OA\Parameter(
     *          name="nama",
     *          in="query",
     *          description="User's name",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          description="User's email",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="no_telefon",
     *          in="query",
     *          description="User's phone number",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          in="query",
     *          description="Chosen password from user",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="password_confirm",
     *          in="query",
     *          description="Password confirmation",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Request OK",
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Validation failed",
     *      ),
     * )
     */
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
            ], 401);
        }

        $input = $request->all();

        /**
         * insert data ke table users
         */
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        
        $success['token'] = $user->createToken('userRegister')->accessToken;

        /**
         * insert data ke tabel tb_konsumen
         */
        $konsumen = new Konsumen();
        $konsumen->Nama_Konsumen = $input['nama'];
        $konsumen->No_Telfon_Konsumen = $input['no_telefon'];
        $konsumen->Email_Konsumen = $input['email'];
        $konsumen->Password = $input['password'];
        $konsumen->user_id = $user->id;
        $konsumen->save();

        $success['nama_konsumen'] = $konsumen->Nama_Konsumen;
        $success['email_konsumen'] = $user->email; // pakai email dari tabel users

        /**
         * $success untuk nilai balikan register()
         * 
         * $success['token']
         * $success['nama_konsumen']
         * $success['email_konsumen']
         */

        return response()->json($success, 200);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json([
            'success' => $user
        ], 200);
    }
}
