<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbDompetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_dompet', function(Blueprint $table)
		{
			$table->foreign('Id_Konsumen', 'tb_dompet_ibfk_1')->references('Id_Konsumen')->on('tb_konsumen')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_dompet', function(Blueprint $table)
		{
			$table->dropForeign('tb_dompet_ibfk_1');
		});
	}

}
