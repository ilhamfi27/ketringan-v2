<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPaketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_jenis_paket')->delete();
        $allData = [
            [1, 'Box'],
            [2, 'Ala Carte'],
            [4, 'Khusus'],
            [5, 'Harian'],
            [6, 'Prasmanan'],
            [7, 'Snack'],
        ];
        foreach ($allData as $data) {
            DB::table('tb_jenis_paket')->insert([
                'Id_Jenis_Menu' => $data[0],
                'Nama_Jenis' => $data[1],
            ]);
        }
    }
}
