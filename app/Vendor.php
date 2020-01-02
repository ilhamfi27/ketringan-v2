<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_vendor';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Vendor';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Nama_Vendor', 
        'Kategori_Vendor', 
        'No_Telfon_Vendor', 
        'No_Telfon_Alternatif_Vendor', 
        'Email_Vendor', 
        'Alamat_Vendor', 
        'Deskripsi_Vendor', 
        'Foto_Profil_Vendor', 
        'Nama_Pemilik', 
        'No_KTP', 
        'Kuota_Pemesanan', 
        'Minimal_Pemesanan', 
        'Status_Vendor', 
        'Id_Akun', 
    ];

    public function menu()
    {
        return $this->hasMany('App\Menu', 'Id_Vendor');
    }
}
