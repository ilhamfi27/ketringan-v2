<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbMvKategorimenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_mv_kategorimenu', function (Blueprint $table) {
            $table->bigInteger('Id_Menu_Paket')->unsigned();
            $table->bigInteger('Id_Kategori_Menu')->unsigned();
            $table->foreign('Id_Menu_Paket')
                  ->references('Id_Menu_Paket')
                  ->on('tb_menu_paket')
                  ->onDelete('cascade');
            $table->foreign('Id_Kategori_Menu')
                  ->references('Id_Kategori_Menu')
                  ->on('tb_kategori_paket')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_mv_kategorimenu');
    }
}
