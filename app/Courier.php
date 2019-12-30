<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_kurir';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Kurir';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Nama_Kurir', 'No_Telfon_Kurir', 'Status_Akun', 'Status_Kurir',
    ];
}
