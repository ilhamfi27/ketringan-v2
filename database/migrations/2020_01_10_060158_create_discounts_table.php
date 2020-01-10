<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     *   `Kode_Diskon` varchar(50) NOT NULL,
     *   `Minimal_Pembelian` int(11) NOT NULL,
     *   `Jenis_Diskon` enum('reguler','persen','tag','') NOT NULL,
     *   `Keterangan_Diskon` text NOT NULL,
     *   `Besar_Diskon` int(11) NOT NULL,
     *   `Maksimal_Diskon` int(11) NOT NULL,
     *   `Status_Diskon` enum('enable','disable') NOT NULL DEFAULT 'disable',
     *   `Created_At` timestamp NOT NULL DEFAULT current_timestamp(),
     *   `Actived_At` timestamp NULL DEFAULT NULL,
     *   `Expired_At` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
     */
    public function up()
    {
        Schema::create('tb_diskon', function (Blueprint $table) {
            $table->bigIncrements('Id_Diskon');
            $table->string('Kode_Diskon', 50);
            $table->integer('Minimal_Pembelian');
            $table->enum('Jenis_Diskon', ['reguler','persen','tag','']);
            $table->text('Keterangan_Diskon');
            $table->integer('Besar_Diskon');
            $table->integer('Maksimal_Diskon');
            $table->enum('Status_Diskon', ['enable','disable'])->default('disable');
            $table->timestamp('Created_At')
                  ->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->timestamp('Actived_At')
                  ->nullable()
                  ->default(null);
            $table->timestamp('Expired_At')
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
        Schema::dropIfExists('tb_diskon');
    }
}
