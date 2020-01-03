<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_transfer';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Transfer';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Id_Pembayaran', 'Nama_Pemegang_Rekening', 
        'Nama_Bank_Pengirim', 'Status_Verifikasi', 
        'Jumlah_Transfer', 'Keterangan', 'Tgl_Transfer', 
        'Tgl_Batas_Transfer', 'Tgl_Dikonfirmasi', 'Bukti_Transfer', 
        'Id_Bank', 
    ];

    public function payment()
    {
        return $this->belongsTo('App\Payment', 'Id_Pembayaran');
    }
}
