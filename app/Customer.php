<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_konsumen';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id_Konsumen';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Nama_Konsumen', 'Role', 'No_Telfon_Konsumen', 'Email_Konsumen', 'Password', 
        'Alamat_Konsumen', 'Foto_Profil_Konsumen', 'Membership', 'is_verifed', 'line_id'
    ];

    protected $hidden = [
        'Password',
    ];

    /**
     * Relasi dengan user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'Id_Konsumen');
    }

    public function payment()
    {
        return $this->hasManyThrough('App\Payment', 'App\Order', 'Id_Konsumen', 'Id_Pembayaran');
    }
}
