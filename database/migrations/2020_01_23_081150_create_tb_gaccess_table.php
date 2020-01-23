<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbGaccessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_gaccess', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Group_Access');
			$table->string('Access_Name', 50);
			$table->text('Description', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_gaccess');
	}

}
