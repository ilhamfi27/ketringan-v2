<?php

namespace App\Http\Controllers\Traits;
use JD\Cloudder\Facades\Cloudder;

trait ImageUpload
{
    public function storePaymentProof($file)
    {
        if(env('APP_ENV') != 'local'){
            Cloudder::upload($file, null, [
                'folder' => 'ketringan/payment_confirmation/'
            ]);
            return Cloudder::getResult()['url']; // to direct get image url from cloudinary
        }
        return $file->store('proof_of_payment');
    }
}
