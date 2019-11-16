<?php

use Illuminate\Database\Seeder;

class TestimoniTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData = [
            [1, 'Rafata Baharansyah', 'Ketua Himpunan Ketringan', 'user1.png', 'Makanan sangat enak, banyak dan bersih, sangat direkomendasikan untuk acara-acara di kampus.', '2019-09-11 11:15:47', 'enable'],
        ];
        foreach ($allData as $data) {
            DB::table('tb_testimoni')->insert([
                'Id_Testimoni' => $data[0],
                'Nama_Pemtestimoni' => $data[1],
                'Jabatan' => $data[2],
                'Foto_Pemtestimoni' => $data[3],
                'Isi_Testimoni' => $data[4],
                'Tgl_Testimoni' => $data[5],
                'Status_Testimoni' => $data[6],
            ]);
        }
    }
}
