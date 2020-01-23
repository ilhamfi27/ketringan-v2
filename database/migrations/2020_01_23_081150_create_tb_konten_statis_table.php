<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbKontenStatisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_konten_statis', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Konten_Statis');
			$table->string('Judul', 100);
			$table->text('Konten', 65535);
			$table->enum('Status', array('enable','disable','',''));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_konten_statis');
	}

}
