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
    protected $primaryKey = 'Id_Menu_Paket';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Nama_Paket', 'Gambar_Paket', 'Harga_Paket', 'Deskripsi_Paket', 
        'Kategori_Paket', 'Id_Vendor', 'Id_Diskon'
    ];

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Vendor', 'Id_Vendor');
    }

    public static function getMenu(
        $id_jenis_menu = null, $region = null, $max_price = null, $min_price = null
        , $pagination_num = 15)
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
                        'tb_vendor.*')->distinct();

        if ($id_jenis_menu != null) {
            $menu->where('tb_jenis_paket.Id_Jenis_Menu', '=', $id_jenis_menu);
        }

        if ($region != null) {
            $menu->where('tb_region.Id_Region', '=', $region);
        }

        if ($max_price != null) {
            $menu->where('tb_menu_paket.Harga_Paket', '<=', $max_price);
        }

        if ($min_price != null) {
            $menu->where('tb_menu_paket.Harga_Paket', '>=', $min_price);
        }

        return $pagination_num != null ? $menu->paginate($pagination_num) : $menu->paginate() ;
    }

    public static function sumPrices($menuIds, $qty)
    {
        $totalPrice = 0;
        foreach ($menuIds as $idx => $id) {
            $totalPrice += (self::find($id)->Harga_Paket) * $qty[$idx];
        }
        return $totalPrice;
    }
}
