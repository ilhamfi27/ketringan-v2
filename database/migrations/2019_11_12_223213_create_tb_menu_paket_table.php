<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbMenuPaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_menu_paket', function (Blueprint $table) {
            $table->bigIncrements('Id_Menu_Paket');
            $table->string('Nama_Paket', 50)->nullable()->default('text');
            $table->text('Gambar_Paket')->nullable()->default(null);
            $table->integer('Harga_Paket');
            $table->string('Deskripsi_Paket')->nullable()->default('text');
            $table->enum('Kategori_Paket', ['event','harian'])->nullable()->default(null);
            $table->bigInteger('Id_Vendor')->unsigned()->nullable()->default(null);
            $table->bigInteger('Id_Diskon')->unsigned()->default(0);
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
        Schema::dropIfExists('tb_menu_paket');
    }
}
