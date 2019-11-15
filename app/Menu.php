<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_menu_paket';

    /**
     * Deklarasi custom primary key 
     */
    protected $primary_key = 'Id_Menu_Paket';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Nama_Paket', 'Gambar_Paket', 'Harga_Paket', 'Deskripsi_Paket', 
        'Kategori_Paket', 'Id_Vendor', 'Id_Diskon'
    ];

    public static function getMenu(
        $region = null, $kategori_menu = null, $max_price = null, $min_price = null)
    {
        $menu = DB::table('tb_menu_paket')
            ->join('tb_vendor', 'tb_vendor.Id_Vendor', '=', 'tb_menu_paket.Id_Vendor')
            ->join('tb_subregion', 'tb_subregion.Id_Subregion', '=', 'tb_vendor.Id_Subregion')
            ->join('tb_mv_region', 'tb_mv_region.Id_Subregion', '=', 'tb_subregion.Id_Subregion')
            ->join('tb_region', 'tb_region.Id_Region', '=', 'tb_mv_region.Id_Region')
            ->join('tb_mv_kategorimenu', 'tb_mv_kategorimenu.Id_Menu_Paket', '=', 'tb_menu_paket.Id_Menu_Paket')
            ->join('tb_kategori_paket', 'tb_kategori_paket.Id_Kategori_Menu', '=', 'tb_mv_kategorimenu.Id_Kategori_Menu')
            ->join('tb_jenis_paket', 'tb_jenis_paket.Id_Jenis_Menu', '=', 'tb_kategori_paket.Id_Jenis_Menu')
            ->select('tb_menu_paket.*', 'tb_region.Region', 'tb_subregion.Subregion', 
                        'tb_vendor.*', 'tb_kategori_paket.Nama_Kategori', 'tb_jenis_paket.Nama_Jenis');

        if ($region != null) {
            $menu->where('tb_region.Id_Region', '=', $region);
        }

        if ($kategori_menu != null) {
            $menu->where('tb_mv_kategorimenu.Id_Kategori_Menu', '=', $kategori_menu);
        }

        if ($max_price != null) {
            $menu->where('tb_menu_paket.Harga_Paket', '<=', $max_price);
        }

        if ($min_price != null) {
            $menu->where('tb_menu_paket.Harga_Paket', '>=', $min_price);
        }

        return $menu->get();
    }
}
