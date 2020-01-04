<?php

namespace App\Http\Controllers\Traits;

trait ImageUpload
{
    public function storePaymentProof($file)
    {
        return $file->store('proof_of_payment');
    }
}
