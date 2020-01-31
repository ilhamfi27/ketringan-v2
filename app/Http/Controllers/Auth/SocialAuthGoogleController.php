<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Carbon\Carbon;
use Exception;
use App\User;
use App\Customer;
use App\SocializedAccount;
use Illuminate\Support\Facades\DB;

class SocialAuthGoogleController extends Controller
{
    private $googleSocialite;

    public function __construct() {
        $this->googleSocialite = Socialite::driver('google');
    }

    public function login()
    {
        return $this->googleSocialite->redirect();
    }

    public function login_callback()
    {
        try {
            $googleUser = $this->googleSocialite->user();

            $googleId = $googleUser->id;
            
            $existingUser = User::where('email', $googleUser->email)->count();
            if($existingUser > 1){
                return view('auth.social_callback')->with([
                    'user_exists' => true,
                ]);
            }

            if(!$this->userSocialiteRegistered($googleId)){
                DB::beginTransaction();
                try {
                    $user = new User;
                    $random_password = str_random(40);
                    $user->email = $googleUser->email;
                    $user->password = $random_password;
                    $user->email_verified_at = Carbon::now()->timestamp;
                    $user->save();
        
                    $data_user = new Customer;
                    $data_user->Nama_Konsumen = $googleUser->name;
                    $data_user->Foto_Profil_Konsumen = $googleUser->avatar;
                    $data_user->Password = $random_password;
                    $data_user->user_id = $user->id;
                    $data_user->save();
        
                    $socializedAccount = new SocializedAccount;
                    $socializedAccount->account_id = $googleUser->id;
                    $socializedAccount->provider = 'google';
                    $socializedAccount->user_id = $user->id;
                    $socializedAccount->save();
                    DB::commit();
                } catch (\Exception $e) { 
                    DB::rollback();
                    return view('auth.social_callback')->with([
                        'error_response' => true,
                    ]);
                }
                $token = $user->createToken('userLogin')->accessToken;

                return view('auth.social_callback')->with([
                    'token' => $token,
                    'Nama_Konsumen' => $data_user->Nama_Konsumen,
                    'email' => $user->email,
                    'is_verified' => true,
                    'socialized_account' => true,
                    'user_exists' => false,
                ]);
            } else {
                $user = Auth::user();
                $konsumen = $user->customer()->first();
                $token = $user->createToken('userLogin')->accessToken;
    
                return view('auth.social_callback')->with([
                    'token' => $token,
                    'Nama_Konsumen' => $konsumen->Nama_Konsumen,
                    'email' => $user->email,
                    'is_verified' => true,
                    'socialized_account' => true,
                    'user_exists' => false,
                ]);
            }
        } catch (Exception $e) {
            // echo $e;
        }
    }

    private function userSocialiteRegistered($googleId)
    {
        $socializedAccount = 
                SocializedAccount::where([
                    ['account_id', '=', $googleId],
                    ['provider', '=', 'google'],
                ]);
        $socializedUser = $socializedAccount->first();
        
        if(isset($socializedUser)){
            $user = User::find($socializedUser->user_id);
            Auth::login($user);
            return Auth::check();
        }
        return false;
    }
}
