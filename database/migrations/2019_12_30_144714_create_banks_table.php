<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bank', function (Blueprint $table) {
            $table->bigIncrements('Id_Bank');
            $table->string('Nama_Bank', 50);
            $table->string('No_Rekening', 100);
            $table->string('Deskripsi', 100);
            $table->text('Logo_Bank');
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
        Schema::dropIfExists('tb_bank');
    }
}
