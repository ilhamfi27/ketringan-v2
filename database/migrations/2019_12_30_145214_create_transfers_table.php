<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transfer', function (Blueprint $table) {
            $table->bigIncrements('Id_Transfer');
            $table->bigInteger('Id_Pembayaran')->unsigned();
            $table->string('Nama_Pemegang_Rekening', 50)
                  ->nullable()
                  ->default(null);
            $table->string('Nama_Bank_Pengirim', 20)
                  ->nullable()
                  ->default(null);
            $table->enum('Status_Verifikasi', ['sudah','belum'])->default('belum');
            $table->integer('Jumlah_Transfer')
                  ->nullable()
                  ->default(null);
            $table->text('Keterangan')
                  ->nullable()
                  ->default(null);
            $table->timestamp('Tgl_Transfer')
                  ->nullable()
                  ->default(null);
            $table->timestamp('Tgl_Batas_Transfer')
                  ->nullable()
                  ->default(null);
            $table->timestamp('Tgl_Dikonfirmasi')
                  ->nullable()
                  ->default(null);
            $table->text('Bukti_Transfer')
                  ->nullable()
                  ->default(null);
            $table->bigInteger('Id_Bank')->unsigned();
            $table->foreign('Id_Pembayaran')
                  ->references('Id_Pembayaran')
                  ->on('tb_pembayaran')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('Id_Bank')
                  ->references('Id_Bank')
                  ->on('tb_bank')
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
        Schema::dropIfExists('tb_transfer');
    }
}
