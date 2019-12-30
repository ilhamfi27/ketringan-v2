<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pesanan', function (Blueprint $table) {
            $table->bigIncrements('Id_Pesanan');
            $table->string('Kode_Pesanan', 20);
            $table->bigInteger('Id_Konsumen')->unsigned();
            $table->text('Alamat_Pengiriman');
            $table->string('No_Telfon_Aktif', 20);
            $table->string('No_Telfon_Alternatif', 20)
                  ->nullable()
                  ->default(null);
            $table->bigInteger('Total_Harga');
            $table->timestamp('Tanggal_Pesan')
                  ->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->date('Tanggal_Kegiatan')->default(null);
            $table->text('Waktu_Kegiatan')->nullable();
            $table->timestamp('Waktu_Diterima')
                  ->nullable()->default(null);
            $table->enum('Status_Pesanan', 
                    ['menunggu_verifikasi_cicilan', 
                    'belum_dibayar', 
                    'menunggu_verifikasi', 
                    'diproses', 
                    'belum_dikirim', 
                    'dikirim', 
                    'selesai', 
                    'dibatalkan']);
            $table->bigInteger('Id_Kurir')
                  ->unsigned()
                  ->nullable()
                  ->default(null);
            $table->foreign('Id_Konsumen')
                  ->references('Id_Konsumen')
                  ->on('tb_konsumen')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('Id_Kurir')
                  ->references('Id_Kurir')
                  ->on('tb_kurir')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

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
        Schema::dropIfExists('tb_pesanan');
    }
}
