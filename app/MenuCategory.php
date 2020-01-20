<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_kategori_paket';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Kategori_Menu';

    public function menuType()
    {
        return $this->belongsTo('App\MenuType', 'Id_Jenis_Menu');
    }
}
