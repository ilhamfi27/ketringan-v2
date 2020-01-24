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

class SocialAuthFacebookController extends Controller
{
    private $facebookSocialite;

    public function __construct() {
        $this->facebookSocialite = Socialite::driver('facebook');
    }

    public function login()
    {
        return $this->facebookSocialite->redirect();
    }

    public function login_callback()
    {
        try {
            $facebookUser = $this->facebookSocialite->user();

            $facebookId = $facebookUser->id;

            if(!$this->userSocialiteRegistered($facebookId)){
                DB::beginTransaction();
                try {
                    $user = new User;
                    $random_password = str_random(40);
                    $user->email = $facebookUser->email;
                    $user->password = $random_password;
                    $user->email_verified_at = Carbon::now()->timestamp;
                    $user->save();
        
                    $data_user = new Customer;
                    $data_user->Nama_Konsumen = $facebookUser->name;
                    $data_user->Foto_Profil_Konsumen = $facebookUser->avatar;
                    $data_user->Password = $random_password;
                    $data_user->user_id = $user->id;
                    $data_user->save();
        
                    $socializedAccount = new SocializedAccount;
                    $socializedAccount->account_id = $facebookUser->id;
                    $socializedAccount->provider = 'facebook';
                    $socializedAccount->user_id = $user->id;
                    $socializedAccount->save();
                    DB::commit();
                } catch (\Exception $e) { 
                    DB::rollback();
                    echo $e; 
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
        } catch (Exception $e) {
            // echo $e;
        }
    }

    private function userSocialiteRegistered($facebookId)
    {
        $socializedAccount = 
                SocializedAccount::where([
                    ['account_id', '=', $facebookId],
                    ['provider', '=', 'facebook'],
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
