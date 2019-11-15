<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbMvRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_mv_region', function (Blueprint $table) {
            $table->bigInteger('Id_Region')->unsigned();
            $table->bigInteger('Id_Subregion')->unsigned();
            $table->foreign('Id_Region')
                  ->references('Id_Region')
                  ->on('tb_region')
                  ->onDelete('cascade');
            $table->foreign('Id_Subregion')
                  ->references('Id_Subregion')
                  ->on('tb_subregion')
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
        Schema::dropIfExists('tb_mv_region');
    }
}
