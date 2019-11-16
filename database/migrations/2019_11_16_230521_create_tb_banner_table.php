<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
//   `Id_Banner` int(11) NOT NULL AUTO_INCREMENT,
//   `Nama_Banner` varchar(100) NOT NULL,
//   `Banner` text NOT NULL,
//   `Status` enum('Enable','Disable') NOT NULL DEFAULT 'Disable',
    public function up()
    {
        Schema::create('tb_banner', function (Blueprint $table) {
            $table->bigIncrements('Id_Banner');
            $table->string('Nama_Banner');
            $table->text('Banner');
            $table->enum('Status', ['Enable','Disable'])->default('Disable');
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
        Schema::dropIfExists('tb_banner');
    }
}
