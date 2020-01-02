<?php

use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_vendor')->delete();
        $allData = [
            [1, 'RM Barokah Jaya Masakan Padang', 'Rumah Makan', '082378211387', '', 'rmbarokahjaya89@gmail.com', 'Sukapura', 'Rumah makan yang menyediakan masakan khas Padang d', '', 'Julianto', '1812061707890004', 1000, 10, 'aktif', 2, 2],
            [2, 'Rumah Makan Nasi "Ibu Yuyun"', 'Rumah Makan', '081221728840', NULL, 'asd@gmail.com', 'Gg. PGA RT04/RW02 Desa Lengkong Kec. Bojongsoang', 'Makanan Rumahan', '', 'Wina Yuningsih', '3204086203670001', 500, 20, 'aktif', 3, 1],
            [3, 'Ayam Ratu Pedas', 'Rumah Makan', '081255199678', '082143864619', '', 'Gang Demang IV RT 3 / RW 4 Bojongsoang', 'Menyediakan berbagai macam hidangan ayam', '', 'Aryati Surtianah', '3277025911720018', 200, 20, 'aktif', 5, 4],
            [4, 'Warung E.M.B.', 'Rumah Makan', '08227500246', '', '', 'JL. Mangga 2 No. 80 Sukapura', 'Menyediakan berbagai macam nasi', '', 'Ghozali', '3318193008020001', 700, 20, 'aktif', 6, 3],
            [5, 'Ketringan', 'Rumahan', '082240660389', '08229865050', 'ketringan.team@gmail.com', 'Jl. Telekomunikasi No.1', 'Menyediakan tambahan makanan ', '', 'Rizsa El Akbar', '7601031103990002', 1000, 20, 'aktif', 8, NULL],
        ];
        foreach ($allData as $data) {
            DB::table('tb_vendor')->insert([
                'Id_Vendor' => $data[0],
                'Nama_Vendor' => $data[1],
                'Kategori_Vendor' => $data[2],
                'No_Telfon_Vendor' => $data[3],
                'No_Telfon_Alternatif_Vendor' => $data[4],
                'Email_Vendor' => $data[5],
                'Alamat_Vendor' => $data[6],
                'Deskripsi_Vendor' => $data[7],
                'Foto_Profil_Vendor' => $data[8],
                'Nama_Pemilik' => $data[9],
                'No_KTP' => $data[10],
                'Kuota_Pemesanan' => $data[11],
                'Minimal_Pemesanan' => $data[12],
                'Status_Vendor' => $data[13],
                'Id_Akun' => $data[14],
                'Id_Subregion' => $data[15],
            ]);
        }
    }
}
