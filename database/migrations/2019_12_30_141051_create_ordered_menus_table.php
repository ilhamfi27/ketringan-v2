<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderedMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_paket_dipesan', function (Blueprint $table) {
            $table->bigInteger('Id_Pesanan')->unsigned();
            $table->bigInteger('Id_Menu_Paket')->unsigned();
            $table->integer('Jumlah_Kotak');
            $table->text('Catatan');
            $table->bigInteger('Harga');
            $table->foreign('Id_Pesanan')
                  ->references('Id_Pesanan')
                  ->on('tb_pesanan')
                  ->onDelete('cascade');
            $table->foreign('Id_Menu_Paket')
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
        Schema::dropIfExists('tb_paket_dipesan');
    }
}
