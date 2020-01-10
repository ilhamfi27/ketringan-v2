<?php

use Illuminate\Database\Seeder;

class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_diskon')->delete();
        $allData = [
            [1, 'OPENINGDISKON', 400000, 'reguler', 'Menyambut opening ketringan', 10000, 0, 'disable', '2019-07-18 09:17:54', NULL, '2019-07-18 09:30:00'],
            [2, 'KETRINGANCERIA', 500000, 'persen', 'Diskon baru dari ketringan', 3, 15000, 'disable', '2019-07-18 09:18:36', NULL, '2019-07-18 17:00:00'],
            [3, 'RAMADHANTIBA', 0, 'tag', 'Menyambut ramadhan', 3, 0, 'disable', '2019-07-18 09:19:10', '2019-07-18 09:19:14', '2019-07-18 09:30:00'],
            [4, 'LIBURTLAHTIBA', 0, 'tag', 'Menyambu tliburan', 5, 0, 'disable', '2019-07-18 09:19:48', '2019-07-18 09:19:51', '2019-07-18 17:00:00'],
        ];
        foreach ($allData as $data) {
            DB::table('tb_diskon')->insert([
                'Id_Diskon' => $data[0],
                'Kode_Diskon' => $data[1],
                'Minimal_Pembelian' => $data[2],
                'Jenis_Diskon' => $data[3],
                'Keterangan_Diskon' => $data[4],
                'Besar_Diskon' => $data[5],
                'Maksimal_Diskon' => $data[6],
                'Status_Diskon' => $data[7],
                'Created_At' => $data[8],
                'Actived_At' => $data[9],
                'Expired_At' => $data[10],
            ]);
        }
    }
}
