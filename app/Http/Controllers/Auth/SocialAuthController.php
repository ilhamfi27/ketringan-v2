<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Carbon\Carbon;
use Exception;
use App\User;
use App\Customer;
use App\SocializedAccount;
use Illuminate\Support\Facades\DB;

class SocialAuthController extends Controller
{
    private $facebookSocialite;
    private $googleSocialite;

    public function __construct() {
        $this->facebookSocialite = Socialite::driver('facebook');
        $this->googleSocialite = Socialite::driver('google');
    }

    public function googleLogin()
    {
        return $this->googleSocialite->redirect();
    }

    public function facebookLogin()
    {
        return $this->facebookSocialite->redirect();
    }

    public function googleLoginCallback()
    {
        try {
            $socialUser = $this->googleSocialite->user();
            $this->socialLogin($socialUser, 'google');
        } catch (Exception $e) {
            // echo $e;
        }
    }

    public function facebookLoginCallback()
    {
        try {
            $socialUser = $this->facebookSocialite->user();
            $this->socialLogin($socialUser, 'facebook');
        } catch (Exception $e) {
            // echo $e;
        }
    }

    private function socialLogin($socialUser, $provider)
    {
        $socialUserId = $socialUser->id;
        
        $existingUser = User::where('email', $socialUser->email)->first();
        if($existingUser != null && $existingUser->count() > 0){
            $user = User::find($existingUser->id);
            Auth::login($user);
            
            $konsumen = $user->customer()->first();
            $token = $user->createToken('userLogin')->accessToken;

            return view('auth.social_callback')->with([
                'token' => $token,
                'Nama_Konsumen' => $konsumen->Nama_Konsumen,
                'email' => $user->email,
                'is_verified' => true,
                'socialized_account' => true,
            ]);
        }

        if(!$this->userSocialiteRegistered($socialUserId, $provider)){
            DB::beginTransaction();
            try {
                $user = new User;
                $random_password = Hash::make(str_random(40));
                $user->email = $socialUser->email;
                $user->password = $random_password;
                $user->email_verified_at = Carbon::now()->timestamp;
                $user->save();
    
                $data_user = new Customer;
                $data_user->Nama_Konsumen = $socialUser->name;
                $data_user->Foto_Profil_Konsumen = $socialUser->avatar;
                $data_user->Password = $random_password;
                $data_user->user_id = $user->id;
                $data_user->save();
    
                $socializedAccount = new SocializedAccount;
                $socializedAccount->account_id = $socialUser->id;
                $socializedAccount->provider = $provider;
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
            ]);
        }
    }

    private function userSocialiteRegistered($userSocialiteId, $provider)
    {
        $socializedAccount = 
                SocializedAccount::where([
                    ['account_id', '=', $userSocialiteId],
                    ['provider', '=', $provider],
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
