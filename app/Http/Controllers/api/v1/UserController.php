<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

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
     *          name="name",
     *          in="query",
     *          description="User's Name",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          description="User's email",
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
     *      @OA\Response(response="default", description="Welcome page")
     * )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('userRegister')->accessToken;
        $success['name'] = $user->name;

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
