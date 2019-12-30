<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_denda', function (Blueprint $table) {
            $table->bigIncrements('Id_Denda');
            $table->integer('Id_Pembayaran');
            $table->integer('Jumlah_Denda');
            $table->string('Keterangan', 50)->nullable()->default(null);
            $table->date('Tgl_Denda');
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
        Schema::dropIfExists('tb_denda');
    }
}
