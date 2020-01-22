<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBannerAndKetentuanOnDiskonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_diskon', function (Blueprint $table) {
            $table->text('Banner')
                ->nullable()
                ->after('Status_Diskon');
            $table->text('Ketentuan')
                ->nullable()
                ->after('Banner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_diskon', function (Blueprint $table) {
            $table->dropColumn(['Banner', 'Ketentuan']);
        });
    }
}
