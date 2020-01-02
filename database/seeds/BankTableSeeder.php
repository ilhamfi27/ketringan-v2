<?php

use Illuminate\Database\Seeder;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_bank')->delete();
        $allData = [
            [
                1,
                'BRI', 
                '1680 01 000578 537', 
                'Rizsa El Akbar', 
                'bri.jpg'
            ],
            [
                2,
                'BNI', 
                '578409572', 
                'Muhammad Dafa', 
                'bank_bni.png'
            ],
            [
                3,
                'BCA', 
                '7750979623', 
                'Rizsa El Akbar', 
                'bank_bca.png'
            ],
        ];
        foreach ($allData as $data) {
            DB::table('tb_bank')->insert([
                'Id_Bank' => $data[0], 
                'Nama_Bank' => $data[1], 
                'No_Rekening' => $data[2], 
                'Deskripsi' => $data[3], 
                'Logo_Bank' => $data[4], 
            ]);
        }
    }
}
