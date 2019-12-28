<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_keranjang';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'id_konsumen', 
        'id_menu', 
        'quantity',
        'created_at',
        'updated_at',
    ];

    public function menu()
    {
        return $this->hasOne('App\Menu', 'Id_Menu_Paket', 'id_menu');
    }
}
