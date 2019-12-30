<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_banner';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Banner';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Nama_Banner',
        'Banner',
        'Status',
    ];
}
