<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuickOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     * CREATE TABLE IF NOT EXISTS `tb_quick_order` (
     *  `Id_Quick_Order` int(11) NOT NULL AUTO_INCREMENT,
     *  `Jenis_Makanan` text NOT NULL,
     *  `No_Telf_Aktif` varchar(50) NOT NULL,
     *  `Tanggal_Pemesanan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
     *  `Waktu_Pemesanan` text NOT NULL,
     *  `Tanggal_Kegiatan` date NOT NULL,
     *  `Jumlah_Pesanan` int(30) NOT NULL,
     *  `Total_Budget` int(30) NOT NULL,
     *  `Harga_Perkotak` int(11) NOT NULL,
     *  `Catatan_Pemesanan` text NOT NULL,
     *  `Status` enum('belum di acc','acc','dibatalkan') DEFAULT 'belum di acc',
     *  `Id_Konsumen` int(11) NOT NULL,
     *  `Alamat` text NOT NULL,
     * PRIMARY KEY (`Id_Quick_Order`),
     * KEY `fk_konsumen` (`Id_Konsumen`)
     * ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
     */
    public function up()
    {
        Schema::create('tb_quick_order', function (Blueprint $table) {
            $table->bigIncrements('Id_Quick_Order');
            $table->text('Jenis_Makanan')
                  ->nullable()
                  ->default(null);
            $table->string('No_Telf_Aktif', 50);
            $table->timestamp('Tanggal_Pemesanan')
                  ->nullable()
                  ->default(null);
            $table->text('Waktu_Pemesanan')
                  ->nullable()
                  ->default(null);
            $table->date('Tanggal_Kegiatan')
                  ->nullable()
                  ->default(null);
            $table->bigInteger('Jumlah_Pesanan')
                  ->nullable()
                  ->default(null);
            $table->bigInteger('Total_Budget')
                  ->nullable()
                  ->default(null);
            $table->bigInteger('Harga_Perkotak')
                  ->nullable()
                  ->default(null);
            $table->text('Catatan_Pemesanan');
            $table->enum('Status', ['belum di acc','acc','dibatalkan'])
                  ->default('belum di acc');
            $table->bigInteger('Id_Konsumen')
                  ->unsigned();
            $table->text('Alamat')
                  ->nullable()
                  ->default(null);
            $table->foreign('Id_Konsumen')
                ->references('Id_Konsumen')
                ->on('tb_konsumen')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_quick_order');
    }
}
