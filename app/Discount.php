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

    public static function getDiscount($kodeDiskon)
    {
        return self::where('Kode_Diskon', $kodeDiskon)
            ->where('Status_Diskon', 'enable')
            ->first();
    }
}
