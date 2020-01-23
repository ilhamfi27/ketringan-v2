<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbItemPoinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_item_poin', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Item_Poin');
			$table->string('Nama_Item', 40);
			$table->integer('Poin');
			$table->string('Kode', 20);
			$table->text('Gambar', 65535)->nullable();
			$table->enum('Status', array('enable','disable'))->default('enable');
			$table->text('keterangan', 65535)->nullable();
			$table->text('Ketentuan', 65535)->nullable();
			$table->text('Cara_Pakai', 65535)->nullable();
			$table->bigInteger('Id_Kategori_Item')->index('fk_kategori_item')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_item_poin');
	}

}
