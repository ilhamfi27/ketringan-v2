<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbKategoriItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_kategori_item', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Kategori_Item');
			$table->string('Kategori_Item', 30);
			$table->text('Gambar', 65535);
			$table->text('Keterangan', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_kategori_item');
	}

}
