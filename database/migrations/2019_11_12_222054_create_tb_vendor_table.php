<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vendor', function (Blueprint $table) {
            $table->bigIncrements('Id_Vendor');
            $table->string('Nama_Vendor', 50);
            $table->enum('Kategori_Vendor', ['Restaurant','Rumah Makan','Rumahan'])
                  ->nullable()->default(null);
            $table->string('No_Telfon_Vendor', 20);
            $table->string('No_Telfon_Alternatif_Vendor', 20)
                  ->nullable()->default(null);
            $table->string('Email_Vendor', 50);
            $table->text('Alamat_Vendor');
            $table->string('Deskripsi_Vendor', 50);
            $table->text('Foto_Profil_Vendor');
            $table->string('Nama_Pemilik', 50);
            $table->string('No_KTP', 20);
            $table->integer('Kuota_Pemesanan');
            $table->integer('Minimal_Pemesanan');
            $table->enum('Status_Vendor', ['aktif','nonaktif'])
                  ->default('nonaktif');
            $table->bigInteger('Id_Akun')->unsigned();
            $table->bigInteger('Id_Subregion')
                  ->unsigned()
                  ->nullable()->default(null);
            $table->foreign('Id_Subregion')
                  ->references('Id_Subregion')
                  ->on('tb_subregion')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('tb_vendor');
    }
}
