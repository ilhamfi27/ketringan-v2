<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbDompetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_dompet', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Dompet');
			$table->bigInteger('Id_Konsumen')->index('Id_Konsumen')->unsigned();
			$table->integer('Nominal_Dompet');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_dompet');
	}

}
