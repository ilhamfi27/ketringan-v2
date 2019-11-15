<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubRegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData = [
            [1, 'Sukabirus A', 'Dari bundaran sampai Bersih Berkah'],
            [2, 'Sukabirus B', 'Dari bersih berkah sampai Belokan KSD'],
            [3, 'Sukapura A', NULL],
            [4, 'Sukapura B', NULL],
            [5, 'Sukapura C', NULL],
        ];
        foreach ($allData as $data) {
            DB::table('tb_subregion')->insert([
                'Id_Subregion' => $data[0],
                'Subregion' => $data[1],
                'Keterangan' => $data[2],
            ]);
        }
    }
}
