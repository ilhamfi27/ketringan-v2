<?php

use Illuminate\Database\Seeder;

class MenuPaketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData = [
            [1, 'Nasi Rendang ala RM Barokah Jaya', NULL, 17000, 'Nasi disajikan dengan daging Rendang khas Padang yang lezat', 'event', 1, 0],
            [2, 'Nasi Ayam ala RM Barokah Jaya', NULL, 13000, 'Nasi disajikan dengan daging ayam serundeng khas Padang yang lezat', 'event', 1, 0],
            [4, 'Paket Quick Order', NULL, 0, 'Paket yang dipesan konsumen melalui Quick Order', 'event', 5, 0],
            [5, 'Paket Kustomisasi Menu', NULL, 0, 'Paket yang dipesan konsumen dengan cara mengkustom menu sendiri', 'event', 5, 0],
            [9, 'Nasi Putih ala Bu Yuyun', NULL, 4000, 'Nasi putih', 'event', 2, 0],
            [11, 'Ayam Fillet Asam Manis ala Bu Yuyun', NULL, 8500, 'Ayam fillet asam manis', 'event', 2, 0],
            [12, 'Ayam Balado Merah ala Bu Yuyun', NULL, 8000, 'ayam goreng dengan bumbu balado merah (belum nasi)', 'event', 2, 0],
            [13, 'Ayam Sambal Ijo ala Bu Yuyun', NULL, 8000, 'Ayam goreng dengan bumbu sambal ijo (belum nasi)', 'event', 2, 0],
            [15, 'Sayur Sop ala Bu Yuyun', NULL, 2500, 'sayur sop segar (belum nasi)', 'event', 2, 0],
            [16, 'Cumi ala Bu Yuyun', NULL, 10000, 'Cumi goreng balado (tanpa nasi)', 'event', 2, 0],
            [18, 'Tuna ala Bu Yuyun', NULL, 6000, 'Tuna Goreng (tanpa nasi)', 'event', 2, 0],
            [21, 'Ikan Patin ala bu Yuyun', NULL, 5000, 'Ikan Patin goreng', 'event', 2, 0],
            [22, 'Tahu Goreng ala Bu Yuyun', NULL, 1000, '1 pcs tahu goreng (tanpa nasi)', 'event', 2, 0],
            [23, 'Tempe Goreng ala Bu Yuyun', NULL, 1000, '1 pcs Tempe Goreng Tepung renyah', 'event', 2, 0],
            [24, 'Perkedel Goreng ala Bu Yuyun', NULL, 1000, '1 pcs Perkedel Goreng ', 'event', 2, 0],
            [25, 'Sayur Bayam ala Bu Yuyun', NULL, 2500, 'seporsi sayur bayam (tanpa nasi)', 'event', 2, 0],
            [28, 'Sosis Sapi Besar ala Bu Yuyun', NULL, 5000, '1 pcs olahan sosis sapi (tanpa nasi)', 'event', 2, 0],
            [29, 'Bakso Sapi ala Bu Yuyun', NULL, 4500, '1 pcs Bakso Sapi  (tanpa nasi)', 'event', 2, 0],
            [30, 'Sosis Sapi Kecil Balado  ala Bu Yuyun', NULL, 2000, '1 pcs Sosis Sapi Kecil Balado', 'event', 2, 0],
            [31, 'Paket Nasi ala Bu Yuyun', NULL, 17500, 'Paket nasi yang terdiri dari nasi, ayam goreng, sayuran, dan sambal ', 'event', 2, 0],
            [32, 'Paket Snack Kotak 1', NULL, 7000, 'Paket snack kotak untuk acara, terdiri dari tiga (3) jenis makanan ringan. Makanan yang dapat dipili', 'event', 5, 0],
            [33, 'Paket Prasmanan', NULL, 0, 'Paket yang dipesan saat konsumen memesan dengan jenis prasmanan', 'event', 5, 0],
            [34, 'Paket Tongkol Sehat', '1565068443_ikan1_telur_sayur.png', 14000, 'Nasi Putih + Ikan Tongkol + Telur + Sayur', 'event', 2, 0],
            [35, 'Paket Jamur Tongkol', '1565068469_jamur_ikan1.png', 11000, 'Nasi Putih + Jamur + Ikan Tongkol', 'event', 2, 0],
            [36, 'Paket Jamur Ikan Patin', '1565068487_jamur_ikan2.png', 10000, 'Nasi Putih + Jamur + Ikan Patin', 'event', 2, 0],
            [37, 'Paket Jamur Ayam', '1565068518_jamur_kecap.png', 13000, 'Nasi Putih + Jamur + Ayam Bumbu Kecap', 'event', 2, 0],
            [38, 'Paket Anak Hedon', '1565068537_jamur_rolade_kecap.png', 13000, 'Nasi Putih + Jamur + Rolade Goreng 2 pcs + Ayam Bumbu Kecap', 'event', 2, 0],
            [39, 'Paket Tongkol Komplit', '1565068570_jamur_telur_ikan1.png', 14000, 'Nasi Putih + Jamur + Telur + Ikan Tongkol', 'event', 2, 0],
            [41, 'Paket Anak Hedon 2', '1565068654_jamur_telur_kecap.png', 16000, 'Nasi Putih + Jamur + Telur + Ayam Bumbu Kecap', 'event', 2, 0],
            [42, 'Paket Sederhana', '1565068683_jamur_telur_rolade.png', 15000, 'Nasi Putih + Jamur + Telur + Rolade Goreng 2 pcs', 'event', 2, 0],
            [43, 'Paket Sehat Sederhana', NULL, 10000, 'Nasi Putih + Jamur + Telur + Sayur', 'event', 2, 0],
            [45, 'Paket Sederhana 2', NULL, 9000, 'Nasi Putih + Jamur + Telur + Tempe Bacem', 'event', 2, 0],
            [46, 'Paket Hemat 1', NULL, 9000, 'Nasi Putih + Jamur + Telur', 'event', 2, 0],
            [47, 'Paket Ayam Kecap 3', NULL, 13000, 'Nasi Putih + Jamur + Tempe Bacem + Ayam Bumbu Kecap', 'event', 2, 0],
            [48, 'Paket Hemat 2', NULL, 7000, 'Nasi Putih + Jamur + Tempe Bacem', 'event', 2, 0],
            [49, 'Paket Ayam Kecap 2', NULL, 13000, 'Nasi Putih + Ayam Bumbu Kecap + Mustofa + Sayur', 'event', 2, 0],
            [50, 'Paket Ayam Sehat', NULL, 14000, 'Nasi Putih + Ayam Bumbu Kecap + Tempe Bacem + Sayur', 'event', 2, 0],
            [51, 'Paket Ikan Tongkol ', NULL, 11000, 'Nasi Putih + Mustofa + Ikan Tongkol', 'event', 2, 0],
            [52, 'Paket Ikan Patin', NULL, 11000, 'Nasi Putih + Mustofa + Ikan Patin', 'event', 2, 0],
            [53, 'Paket Ayam Kecap 1', NULL, 14000, 'Nasi Putih + Mustofa + Ayam Bumbu Kecap', 'event', 2, 0],
            [54, 'Paket Ayam Pedas', NULL, 14000, 'Nasi Putih + Mustofa + Ayam Bumbu Pedas', 'event', 2, 0],
            [55, 'Paket Hemat 4', NULL, 13000, 'Nasi Putih + Mustofa + Rolade Goreng 2 pcs', 'event', 2, 0],
            [56, 'Paket Hemat 5', NULL, 11000, 'Nasi Putih + Mustofa + Telur', 'event', 2, 0],
            [57, 'Paket Hemat 3', NULL, 8000, 'Nasi Putih + Mustofa + Tempe Bacem', 'event', 2, 0],
            [58, 'Paket Pedas Jamur', NULL, 13000, 'Nasi Putih + Ayam Bumbu Pedas + Jamur', 'event', 2, 0],
            [59, 'Paket Pedas Sehat', NULL, 15000, 'Nasi Putih + Ayam Bumbu Pedas + Mustofa + Sayur', 'event', 2, 0],
            [60, 'Paket Pedas Rolade', NULL, 17000, 'Nasi Putih + Ayam Bumbu Pedas + Rolade Goreng 2 pcs', 'event', 2, 0],
            [61, 'Paket Pedas Telur', NULL, 15000, 'Nasi Putih + Ayam Bumbu Pedas + Telur', 'event', 2, 0],
            [62, 'Paket Pedes Bacem', NULL, 12000, 'Nasi Putih + Ayam Bumbu Pedas + Tempe Bacem', 'event', 2, 0],
            [63, 'Paket Ikan Sehat', NULL, 12000, 'Nasi Putih + Sayur + Ikan Tongkol', 'event', 2, 0],
            [64, 'Paket Ikan Sehat 2', NULL, 12000, 'Nasi Putih + Sayur + Ikan Patin', 'event', 2, 0],
            [65, 'Paket Sayur Jamur', NULL, 9000, 'Nasi Putih + Sayur + Jamur', 'event', 2, 0],
            [66, 'Paket Sayur Ayam kecap', NULL, 14000, 'Nasi Putih + Sayur + Ayam Bumbu Kecap', 'event', 2, 0],
            [67, 'Paket Sayur Bumbu pedas', NULL, 14000, 'Nasi Putih + Sayur + Ayam Bumbu Pedas', 'event', 2, 0],
            [68, 'Paket Sehat Rolade', NULL, 13000, 'Nasi Putih + Sayur + Rolade Goreng 2 pcs', 'event', 2, 0],
            [69, 'Paket Goreng with Sayur', NULL, 14000, 'Nasi Putih + Sayur + Goreng', 'event', 2, 0],
            [70, 'Paket Sayur Telur', NULL, 11000, 'Nasi Putih + Sayur + Telur', 'event', 2, 0],
            [71, 'Paket Sayur Tempe', NULL, 8000, 'Nasi Putih + Sayur + Tempe Bacem', 'event', 2, 0],
            [72, 'Paket Ayam Telur', NULL, 15000, 'Nasi Putih + Ayam Goreng + Telur', 'event', 2, 0],
            [73, 'Paket Ayam Sayur', NULL, 15000, 'Nasi Putih + Ayam Goreng + Mustofa + Sayur', 'event', 2, 0],
            [74, 'Paket Ayam Rolade', NULL, 17000, 'Nasi Putih + Ayam Goreng + Rolade Goreng 2 pcs', 'event', 2, 0],
            [75, 'Paket Rolade Lengkap', NULL, 19000, 'Nasi Putih + Ayam Goreng + Rolade Goreng 2 pcs + Sayur', 'event', 2, 0],
            [76, 'Paket Ayam Bacem', NULL, 12000, 'Nasi Putih + Ayam Goreng + Tempe Bacem', 'event', 2, 0],
            [77, 'Paket Bacem Lengkap', NULL, 13000, 'Nasi Putih + Ayam Goreng + Tempe Bacem + Sayur', 'event', 2, 0],
            [78, 'Paket Mustofa Sehat', NULL, 12000, 'Nasi Putih + Telur + Mustofa + Sayur', 'event', 2, 0],
            [79, 'Paket Bacem Sehat', NULL, 9000, 'Nasi Putih + Tempe Bacem + Telur + Sayur', 'event', 2, 0],
        ];
        foreach ($allData as $data) {
            DB::table('tb_menu_paket')->insert([
                'Id_Menu_Paket' => $data[0],
                'Nama_Paket' => $data[1],
                'Gambar_Paket' => $data[2],
                'Harga_Paket' => $data[3],
                'Deskripsi_Paket' => $data[4],
                'Kategori_Paket' => $data[5],
                'Id_Vendor' => $data[6],
                'Id_Diskon' => $data[7],
            ]);
        }
    }
}
