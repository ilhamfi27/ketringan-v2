<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_region';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Region';
}
