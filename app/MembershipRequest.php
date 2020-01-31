<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipRequest extends Model
{
    /**
     * Tabel yang digunakan
     */
    protected $table = 'tb_req_membership';

    /**
     * atribut yang dapat diisi
     */
    protected $fillable = [
        'Id_Konsumen',
        'Tanggal_Request',
        'No_Telfon',
        'Alamat',
        'Catatan',
    ];

    public static function statusStringify($membersipRequests)
    {
        foreach ($membersipRequests as $key => $membersipRequest) {
            $membersipRequests[$key]['Status_Request'] = ucwords(
                str_replace("_", " ", $membersipRequests[$key]['Status_Request']));
        }
        return $membersipRequests;
    }
}
