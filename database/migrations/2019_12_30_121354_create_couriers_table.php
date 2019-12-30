<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kurir', function (Blueprint $table) {
            $table->bigIncrements('Id_Kurir');
            $table->string('Nama_Kurir', 50);
            $table->string('No_Telfon_Kurir', 12);
            $table->enum('Status_Akun', ['aktif','nonaktif']);
            $table->enum('Status_Kurir', ['Tersedia','Sibuk'])->default('Tersedia');
            $table->timestamp('Delete_at')
                  ->nullable()
                  ->default(DB::raw("CURRENT_TIMESTAMP"));
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
        Schema::dropIfExists('tb_kurir');
    }
}
