<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_diskon';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Diskon';

    public function scopeGetByKodeDiskon($query, $kodeDiskon)
    {
        return $query->where('Kode_Diskon', $kodeDiskon);
    }

    public function scopeEnabled($query, $status = true)
    {
        $statusDiskon = $status == true ? 'enabled' : 'disabled';
        return $query->where('Status_Diskon', $statusDiskon);
    }
}
