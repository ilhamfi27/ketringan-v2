<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Carbon\Carbon;
use Exception;
use App\User;
use App\Konsumen;
use App\SocializedAccount;

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
                $user = new User;
                $random_password = str_random(40);
                $user->email = $facebookUser->email;
                $user->password = $random_password;
                $user->email_verified_at = Carbon::now()->timestamp;
                $user->save();
    
                $data_user = new Konsumen;
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
                echo "registered!";
            }
        } catch (Exception $e) {
            return 'error: ' . $e;
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
            if(Auth::check()){
                echo "logged in!";
                return true;
            }
        }
        return false;
    }
}
