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
