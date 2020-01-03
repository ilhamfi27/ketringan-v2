<?php

namespace App\Http\Controllers\Traits;

trait ImageUpload
{

    public function store($file, $folder)
    {
        $user = Auth::user();
        $path = $file->storeAs(
            'proof_of_payment', time() . '_' 
        );
    }
}
