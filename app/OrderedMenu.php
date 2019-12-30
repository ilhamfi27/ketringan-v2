<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedMenu extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_paket_dipesan';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = null;

    /**
     * Menonaktifkan increment pada id
     */
    public $incrementing = false;

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Id_Pesanan', 'Id_Menu_Paket', 'Jumlah_Kotak', 'Catatan', 'Harga',
    ];
}
