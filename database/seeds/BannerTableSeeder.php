<?php

use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_banner')->delete();
        $allData = [
            [1, 'Wallpaper', 'image.jpg', 'Enable'],
            [2, 'Promosi Gratisan', 'image.jpg', 'Disable'],
            [3, 'Promosi Ketringan', 'image.jpg', 'Enable'],
            [4, 'Sarapan Bersama Ketringan', 'image.jpg', 'Enable'],
            [5, 'Ketringan Romantic Dinner', 'image.jpg', 'Enable'],
        ];
        foreach ($allData as $data) {
            DB::table('tb_banner')->insert([
                'Id_Banner' => $data[0],
                'Nama_Banner' => $data[1],
                'Banner' => $data[2],
                'Status' => $data[3],
            ]);
        }
    }
}
