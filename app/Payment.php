<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_pembayaran';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Pembayaran';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Id_Pesanan', 'Metode_Pembayaran', 'Tagihan', 
        'Total_Telah_Dibayar', 'Denda', 'Total_Tagihan', 
        'Sisa_Tagihan', 'Kode_Unik', 'Keterangan_Pembayaran', 
        'Id_Diskon', 'Potongan_Diskon',
    ];
}
