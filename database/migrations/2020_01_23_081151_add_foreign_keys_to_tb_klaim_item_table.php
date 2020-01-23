<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbKlaimItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_klaim_item', function(Blueprint $table)
		{
			$table->foreign('Id_Konsumen', 'tb_klaim_item_ibfk_1')->references('Id_Konsumen')->on('tb_konsumen')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('Id_Item_Poin', 'tb_klaim_item_ibfk_2')->references('Id_Item_Poin')->on('tb_item_poin')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_klaim_item', function(Blueprint $table)
		{
			$table->dropForeign('tb_klaim_item_ibfk_1');
			$table->dropForeign('tb_klaim_item_ibfk_2');
		});
	}

}
