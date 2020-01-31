<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuickOrder extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_quick_order';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Quick_Order';

    protected $fillable = [
        'Id_Quick_Order','Jenis_Makanan','No_Telf_Aktif','Tanggal_Pemesanan','Waktu_Pemesanan','Tanggal_Kegiatan',
        'Jumlah_Pesanan','Total_Budget','Harga_Perkotak','Catatan_Pemesanan','Status','Id_Konsumen','Alamat',
    ];

    public static function statusStringify($quickOrders)
    {
        foreach ($quickOrders as $key => $quickOrder) {
            $quickOrders[$key]['Status'] = ucwords(
                str_replace("_", " ", $quickOrders[$key]['Status']));
        }
        return $quickOrders;
    }
}
