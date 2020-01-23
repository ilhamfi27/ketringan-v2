<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbPenarikanDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_penarikan_deposit', function(Blueprint $table)
		{
			$table->foreign('Id_Deposit', 'tb_penarikan_deposit_ibfk_1')->references('Id_Deposit')->on('tb_deposit')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_penarikan_deposit', function(Blueprint $table)
		{
			$table->dropForeign('tb_penarikan_deposit_ibfk_1');
		});
	}

}
