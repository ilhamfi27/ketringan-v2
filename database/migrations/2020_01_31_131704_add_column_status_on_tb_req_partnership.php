<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusOnTbReqPartnership extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_req_partnership', function (Blueprint $table) {
            $table->enum('Status_Request', ['menunggu_verifikasi', 'proses_verifikasi', 'selesai', 'dibatalkan'])
                  ->default('menunggu_verifikasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_req_partnership', function (Blueprint $table) {
            $table->dropColumn('Status_Request');
        });
    }
}
