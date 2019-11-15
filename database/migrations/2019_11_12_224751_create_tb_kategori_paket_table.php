<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbKategoriPaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kategori_paket', function (Blueprint $table) {
            $table->bigIncrements('Id_Kategori_Menu');
            $table->string('Nama_Kategori', 50);
            $table->enum('Status', ['lama','baru'])->default('baru');
            $table->bigInteger('Id_Jenis_Menu')->unsigned();
            $table->text('Icon')->nullable()->default(null);
            $table->foreign('Id_Jenis_Menu')
                  ->references('Id_Jenis_Menu')
                  ->on('tb_jenis_paket')
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
        Schema::dropIfExists('tb_kategori_paket');
    }
}
