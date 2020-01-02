<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_region')->delete();
        $allData = [
            [1, 'Sukabirus', 'Dari bundaran telkom sampai belokan KSD'],
            [2, 'Sukapura', 'Dari gerbang motor telkom sampai adiyaksa'],
        ];
        foreach ($allData as $data) {
            DB::table('tb_region')->insert([
                'Id_Region' => $data[0],
                'Region' => $data[1],
                'Keterangan' => $data[2],
            ]);
        }
    }
}
