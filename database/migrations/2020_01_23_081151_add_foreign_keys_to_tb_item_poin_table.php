<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbItemPoinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_item_poin', function(Blueprint $table)
		{
			$table->foreign('Id_Kategori_Item', 'tb_item_poin_ibfk_1')->references('Id_Kategori_Item')->on('tb_kategori_item')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_item_poin', function(Blueprint $table)
		{
			$table->dropForeign('tb_item_poin_ibfk_1');
		});
	}

}
