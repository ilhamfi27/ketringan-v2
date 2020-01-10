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
            RegionTableSeeder::class,
            SubRegionTableSeeder::class,
            TestimoniTableSeeder::class,
            VendorTableSeeder::class,
            MultivalueKategoriMenuTableSeeder::class,
            MultiValueRegionTableSeeder::class,
            BankTableSeeder::class,
            DiscountTableSeeder::class,
        ]);
    }
}
