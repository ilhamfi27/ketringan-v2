<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPenarikanDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_penarikan_deposit', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Penarikan_Deposit');
			$table->bigInteger('Id_Deposit')->index('Id_Deposit')->unsigned();
			$table->integer('Nominal_Penarikan');
			$table->date('Tanggal_Penarikan');
			$table->string('Waktu_Penarikan', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_penarikan_deposit');
	}

}
