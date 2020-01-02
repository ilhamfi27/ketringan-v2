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
        'Waktu_Diterima', 'Status_Pesanan', 'Id_Kurir',
    ];

    public function customer()
    {
        $this->belongsTo('App\Customer', 'Id_Konsumen');
    }

    public static function detail($idPesanan)
    {
        return DB::table('tb_pesanan')
                ->join('tb_pembayaran', 'tb_pesanan.Id_Pesanan', '=', 'tb_pembayaran.Id_Pesanan')
                ->join('tb_transfer', 'tb_pembayaran.Id_Pembayaran', '=', 'tb_transfer.Id_Pembayaran')
                ->join('tb_konsumen', 'tb_pesanan.Id_Konsumen', '=', 'tb_konsumen.Id_Konsumen')
                ->select('tb_pesanan.*', 'tb_pembayaran.*', 
                            'tb_transfer.*', 'tb_konsumen.Nama_Konsumen', 
                            'tb_konsumen.Email_Konsumen')
                ->where('tb_pesanan.Id_Pesanan', '=', $idPesanan)
                ->first();
    }
}
