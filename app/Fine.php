<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_denda';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Denda';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Id_Pembayaran', 'Jumlah_Denda', 'Keterangan', 'Tgl_Denda',
    ];
}
