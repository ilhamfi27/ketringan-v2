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
        $allData = [
            [1, 'Wallpaper', 'black-polygon-with-red-edges-abstract-hd-wallpaper-1920x1080.jpg', 'Enable'],
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
