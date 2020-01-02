<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderedMenu extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_paket_dipesan';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = null;

    /**
     * Menonaktifkan increment pada id
     */
    public $incrementing = false;

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Id_Pesanan', 'Id_Menu_Paket', 'Jumlah_Kotak', 'Catatan', 'Harga',
    ];

    public static function orderDetail($orderId)
    {
        return DB::table('tb_paket_dipesan')
                ->join('tb_menu_paket', 'tb_paket_dipesan.Id_Menu_Paket', '=', 'tb_menu_paket.Id_Menu_Paket')
                ->select('tb_paket_dipesan.*', 'tb_menu_paket.*')
                ->where('Id_Pesanan', $orderId)
                ->get();
    }
}
