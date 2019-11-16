<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RegionTableSeeder::class,
            SubRegionTableSeeder::class,
            MultiValueRegionTableSeeder::class,
            JenisPaketTableSeeder::class,
            KategoriPaketTableSeeder::class,
            BannerTableSeeder::class,
            TestimoniTableSeeder::class,
        ]);
    }
}
