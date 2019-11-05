<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKonsumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_konsumen', function (Blueprint $table) {
            $table->bigIncrements('Id_Konsumen');
            $table->string('Nama_Konsumen')->default("");
            $table->enum('Role', ['perseorangan', 'organisasi'])->default('perseorangan');
            $table->string('No_Telfon_Konsumen', 20)->nullable()->default(NULL);
            $table->string('Email_Konsumen', 50)->nullable()->default(NULL);
            $table->string('Password');
            $table->string('Alamat_Konsumen')->nullable()->default(NULL);
            $table->string('Foto_Profil_Konsumen')->nullable()->default(NULL);
            $table->enum('Membership', ['VIP', 'Reguler'])->default('Reguler');
            $table->integer('is_verifed')->default(0);
            $table->string('line_id')->nullable()->default(NULL);

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
        Schema::dropIfExists('tb_konsumen');
    }
}
