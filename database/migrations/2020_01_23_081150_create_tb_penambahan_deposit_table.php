<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPenambahanDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_penambahan_deposit', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Penambahan_Deposit');
			$table->bigInteger('Id_Deposit')->index('Id_Deposit')->unsigned();
			$table->integer('Nominal_Penambahan');
			$table->date('Tanggal_Penambahan');
			$table->string('Waktu_Penambahan', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_penambahan_deposit');
	}

}
