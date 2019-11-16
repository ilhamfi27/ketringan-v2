<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_testimoni';

    /**
     * Deklarasi custom primary key 
     */
    protected $primary_key = 'Id_Testimoni';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Nama_Pemtestimoni', 'Jabatan', 'Foto_Pemtestimoni', 'Isi_Testimoni', 'Tgl_Testimoni', 'Status_Testimoni'
    ];
}
