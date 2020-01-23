<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPoinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_poin', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Poin');
			$table->bigInteger('Id_Konsumen')->index('fk_konsumen')->unsigned();
			$table->integer('Poin');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_poin');
	}

}
