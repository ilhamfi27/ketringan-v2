<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnershipRequest extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_req_partnership';

    /**
     * Deklarasi custom primary key 
     */
    protected $primaryKey = 'Id';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Tanggal_Request',
        'No_Telfon',
        'Alamat',
        'Catatan',
    ];
}
