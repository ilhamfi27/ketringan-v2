<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeranjangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_keranjang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_konsumen')->unsigned();
            $table->bigInteger('id_menu')->unsigned();
            $table->integer('quantity')->default(0);
            $table->foreign('id_konsumen')
                  ->references('Id_Konsumen')
                  ->on('tb_konsumen')
                  ->onDelete('cascade');
            $table->foreign('id_menu')
                  ->references('Id_Menu_Paket')
                  ->on('tb_menu_paket')
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
        Schema::dropIfExists('tb_keranjang');
    }
}
