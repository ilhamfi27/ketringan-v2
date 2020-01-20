<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_jenis_paket';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Jenis_Menu';

    public function menuCategory()
    {
        return $this->hasMany('App\MenuCategory', 'Id_Jenis_Menu');
    }
}
