<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTbReqPartnershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_req_partnership', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->timestamp('Tanggal_Request')->nullable()
                  ->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->string('No_Telfon', 20)->nullable()->default(null);
            $table->text('Alamat');
            $table->text('Catatan');
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
        Schema::dropIfExists('tb_req_partnership');
    }
}
