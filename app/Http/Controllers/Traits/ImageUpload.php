<?php

namespace App\Http\Controllers\Traits;
use JD\Cloudder\Facades\Cloudder;

trait ImageUpload
{
    public function storePaymentProof($file)
    {
        if(env('APP_ENV') == 'staging'){
            return $this->coudinaryUpload($file, 'payment_confirmation');
        } else if (env('APP_ENV') == 'production') {
            return $this->customImageUpload($file, 'bukti_trf');
        }
        return $this->customImageUpload($file, 'bukti_trf');
    }

    public function userAvatarUpdate($file)
    {
        if(env('APP_ENV') == 'staging'){
            return $this->coudinaryUpload($file, 'user_avatar');
        } else if (env('APP_ENV') == 'production') {
            return $this->customImageUpload($file, 'konsumen');
        }
        return $this->customImageUpload($file, 'konsumen');
    }

    private function coudinaryUpload($file, $folder)
    {
        Cloudder::upload($file, null, [
            'folder' => 'ketringan/' . $folder
        ]);
        return Cloudder::getResult()['url']; // to direct get image url from cloudinary
    }

    private function customImageUpload($file, $folder)
    {
        /* get File Extension */
        $extension = $file->getClientOriginalExtension();

        /* Your File Destination */
        $directoryTarget = base_path()."/../public_html/images/" . $folder;
    
        /* unique Name for file */
        $filename = uniqid() . '.' . $extension;
    
        /* finally move file to your destination */
        $file->move($directoryTarget,  $filename);

        return env('APP_LANDING_PAGE').'/images/' . $folder . '/' . $filename;
    }
}
