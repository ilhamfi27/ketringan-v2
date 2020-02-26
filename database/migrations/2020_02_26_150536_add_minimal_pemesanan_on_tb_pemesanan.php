<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMinimalPemesananOnTbPemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_menu_paket', function (Blueprint $table) {
            $table->integer('Minimal_Pemesanan')
                  ->after('Kategori_paket')
                  ->nullable()
                  ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_menu_paket', function (Blueprint $table) {
            $table->dropColumn('Minimal_Pemesanan');
        });
    }
}
