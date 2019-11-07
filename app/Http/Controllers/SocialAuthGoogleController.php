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

class SocialAuthGoogleController extends Controller
{
    public function register()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_register_callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

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
            $socializedAccount->user_id = $user->id;
            $socializedAccount->save();
        } catch (Exception $e) {
            return 'error: ' . $e;
        }
    }
}
