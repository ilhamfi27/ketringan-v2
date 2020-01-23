<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_deposit', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Deposit');
			$table->bigInteger('Id_Vendor')->index('Id_Vendor')->unsigned();
			$table->integer('Nominal_Deposit')->default(0);
			$table->string('Status_Deposit', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_deposit');
	}

}
