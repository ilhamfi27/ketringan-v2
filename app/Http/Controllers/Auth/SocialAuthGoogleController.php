<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Carbon\Carbon;
use Exception;
use App\User;
use App\Konsumen;
use App\SocializedAccount;

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

            if(!$this->userSocialiteRegistered($googleId)){
                $user = new User;
                $random_password = str_random(40);
                $user->email = $googleUser->email;
                $user->password = $random_password;
                $user->email_verified_at = Carbon::now()->timestamp;
                $user->save();
    
                $data_user = new Konsumen;
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

                /**
                 * token untuk login aplikasi
                 */
                $success['token'] = $user->createToken('userRegister')->accessToken;
                
                $success['nama_konsumen'] = $data_user->Nama_Konsumen;
                $success['email_konsumen'] = $user->email; // pakai email dari tabel users
        
                /**
                 * $success untuk nilai balikan register()
                 * 
                 * $success['token'] -> token
                 * $success['nama_konsumen'] -> nama konsumen
                 * $success['email_konsumen'] -> email konsumen
                 */

                return response()->json($success, 200);
            }

            $user = Auth::user();
            $success['token'] = $user->createToken('userLogin')->accessToken;
            return response()->json([
                'success' => $success
            ], 200);

        } catch (Exception $e) {
            return 'error: ' . $e;
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