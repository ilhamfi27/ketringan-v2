<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_konsumen';

    /**
     * Deklarasi custom primary key 
     */
    protected $primary_key = 'Id_Konsumen';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Nama_Konsumen', 'Role', 'No_Telfon_Konsumen', 'Email_Konsumen', 'Password', 
        'Alamat_Konsumen', 'Foto_Profil_Konsumen', 'Membership', 'is_verifed', 'line_id'
    ];

    /**
     * Relasi dengan user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
