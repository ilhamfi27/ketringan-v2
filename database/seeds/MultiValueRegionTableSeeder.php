<?php

use Illuminate\Database\Seeder;

class MultiValueRegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData = [
            [1, 1],
            [1, 2],
            [2, 3],
            [2, 4],
            [2, 5],
        ];
        foreach ($allData as $data) {
            DB::table('tb_mv_region')->insert([
                'Id_Region' => $data[0],
                'Id_Subregion' => $data[1],
            ]);
        }
    }
}
