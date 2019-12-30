<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_pesanan';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Pesanan';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Kode_Pesanan', 'Id_Konsumen', 'Alamat_Pengiriman', 
        'No_Telfon_Aktif', 'No_Telfon_Alternatif', 'Total_Harga', 
        'Tanggal_Pesan', 'Tanggal_Kegiatan', 'Waktu_Kegiatan', 
        'Waktu_Diterima', 'Status_Pesanan', 'Id_Kurir',
    ];
}
