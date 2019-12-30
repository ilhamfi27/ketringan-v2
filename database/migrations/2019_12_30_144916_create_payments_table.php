<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pembayaran', function (Blueprint $table) {
            $table->bigIncrements('Id_Pembayaran');
            $table->bigInteger('Id_Pesanan')
                  ->unsigned()
                  ->nullable()
                  ->default(null);
            $table->enum('Metode_Pembayaran', ['cash','cicil']);
            $table->integer('Tagihan');
            $table->integer('Total_Telah_Dibayar');
            $table->bigInteger('Denda')->unsigned()->default(0);
            $table->integer('Total_Tagihan');
            $table->integer('Sisa_Tagihan');
            $table->integer('Kode_Unik')->default(0);
            $table->enum('Keterangan_Pembayaran', [
                    'lunas',
                    'belum_lunas',
                    'belum_dikembalikan',
                    'dikembalikan'
                ])->default('belum_lunas');
            $table->bigInteger('Id_Diskon')->unsigned();
            $table->integer('Potongan_Diskon');
            $table->foreign('Id_Pesanan')
                  ->references('Id_Pesanan')
                  ->on('tb_pesanan')
                  ->onDelete('cascade');
            $table->foreign('Denda')
                  ->references('Id_Denda')
                  ->on('tb_denda')
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
        Schema::dropIfExists('tb_pembayaran');
    }
}
