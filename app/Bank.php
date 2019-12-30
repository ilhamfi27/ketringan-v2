<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_bank';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Bank';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Nama_Bank', 'No_Rekening', 'Deskripsi', 'Logo_Bank',
    ];
}
