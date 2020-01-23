<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_deposit', function(Blueprint $table)
		{
			$table->foreign('Id_Vendor', 'tb_deposit_ibfk_1')->references('Id_Vendor')->on('tb_vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_deposit', function(Blueprint $table)
		{
			$table->dropForeign('tb_deposit_ibfk_1');
		});
	}

}
