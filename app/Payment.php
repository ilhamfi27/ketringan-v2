<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function order()
    {
        return $this->belongsTo('App\Order', 'Id_Pesanan');
    }

    public function transfer()
    {
        return $this->hasMany('App\Transfer', 'Id_Pembayaran');
    }

    public static function customerDiscount($customerId, $discountId)
    {
        return self::join('tb_pesanan', 'tb_pesanan.Id_pesanan', '=', 'tb_pembayaran.Id_pesanan')
                ->where('Id_Konsumen', $customerId)
                ->where('Id_Diskon', $discountId)
                ->where('Status_Pesanan', '!=', 'dibatalkan')
                ->select('*')
                ->get();
    }

    public function scopeWithDiscount($query, $discountId)
    {
        return $query->where('Id_Diskon', $discountId);
    }
}
