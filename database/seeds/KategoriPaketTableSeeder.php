<?php

use Illuminate\Database\Seeder;

class KategoriPaketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData = [
            [1, 'Paket Ayam dan Bebek', 'lama', 1, NULL],
            [2, 'Paket Ikan', 'lama', 1, NULL],
            [3, 'Lauk', 'lama', 2, NULL],
            [4, 'Sayuran', 'lama', 2, NULL],
            [5, 'Nasi', 'lama', 2, NULL],
            [8, 'Paket Lainnya', 'lama', 1, NULL],
            [9, 'Paket Sayur', 'lama', 1, NULL],
            [10, 'Sistem', 'lama', 4, NULL],
            [11, 'Pagi', 'lama', 5, NULL],
            [12, 'Siang', 'lama', 5, NULL],
            [13, 'Malam', 'lama', 5, NULL],
            [14, 'Paket Irit', 'lama', 5, NULL],
            [15, 'Paket Hedon', 'lama', 5, NULL],
            [16, 'Paket Sultan', 'lama', 5, NULL],
        ];
        foreach ($allData as $data) {
            DB::table('tb_kategori_paket')->insert([
                'Id_Kategori_Menu' => $data[0],
                'Nama_Kategori' => $data[1],
                'Status' => $data[2],
                'Id_Jenis_Menu' => $data[3],
                'Icon' => $data[4],
            ]);
        }
    }
}
