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
            BannerTableSeeder::class,
            JenisPaketTableSeeder::class,
            KategoriPaketTableSeeder::class,
            MenuPaketTableSeeder::class,
            MultivalueKategoriMenu::class,
            MultiValueRegionTableSeeder::class,
            RegionTableSeeder::class,
            SubRegionTableSeeder::class,
            TestimoniTableSeeder::class,
            VendorTableSeeder::class,
        ]);
    }
}
