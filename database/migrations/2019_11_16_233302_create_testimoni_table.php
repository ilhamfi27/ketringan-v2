<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimoniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_testimoni', function (Blueprint $table) {
            $table->bigIncrements('Id_Testimoni');
            $table->string('Nama_Pemtestimoni', 50);
            $table->string('Jabatan');
            $table->string('Foto_Pemtestimoni');
            $table->string('Isi_Testimoni');
            $table->timestamp('Tgl_Testimoni')->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->enum('Status_Testimoni', ['enable','disable']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_testimoni');
    }
}
