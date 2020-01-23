<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbKomplainTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_komplain', function(Blueprint $table)
		{
			$table->foreign('Id_Konsumen', 'tb_komplain_ibfk_1')->references('Id_Konsumen')->on('tb_konsumen')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_komplain', function(Blueprint $table)
		{
			$table->dropForeign('tb_komplain_ibfk_1');
		});
	}

}
