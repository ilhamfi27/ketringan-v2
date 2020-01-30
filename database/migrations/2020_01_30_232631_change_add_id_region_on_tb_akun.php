<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAddIdRegionOnTbAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_akun', function (Blueprint $table) {
            $table->bigInteger('Id_Region')->unsigned();
            $table->foreign('Id_Region')
                  ->references('Id_Region')
                  ->on('tb_region')
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
        Schema::table('tb_akun', function(Blueprint $table)
        {
            $table->dropColumn('Id_Region');
        });
    }
}
