<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'Waktu_Diterima', 'Status_Pesanan', 'Id_Kurir', 'Id_Region',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'Id_Konsumen');
    }

    public function payment()
    {
        return $this->hasOne('App\Order', 'Id_Pesanan');
    }

    public function transfer()
    {
        return $this->hasOneThrough('App\Transfer', 'App\Payment', 'Id_Pesanan', 'Id_Pembayaran');
    }

    public static function detail($idPesanan)
    {
        return DB::table('tb_pesanan')
                ->join('tb_pembayaran', 'tb_pesanan.Id_Pesanan', '=', 'tb_pembayaran.Id_Pesanan')
                ->join('tb_transfer', 'tb_pembayaran.Id_Pembayaran', '=', 'tb_transfer.Id_Pembayaran')
                ->join('tb_konsumen', 'tb_pesanan.Id_Konsumen', '=', 'tb_konsumen.Id_Konsumen')
                ->join('tb_bank', 'tb_bank.Id_Bank', '=', 'tb_transfer.Id_Bank')
                ->select('tb_pesanan.*', 'tb_pembayaran.*', 
                            'tb_transfer.*', 'tb_konsumen.Nama_Konsumen', 
                            'tb_konsumen.Email_Konsumen', 'tb_bank.*')
                ->where('tb_pesanan.Id_Pesanan', '=', $idPesanan)
                ->first();
    }
}
