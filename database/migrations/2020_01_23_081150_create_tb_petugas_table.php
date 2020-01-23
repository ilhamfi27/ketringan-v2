<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPetugasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_petugas', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Petugas');
			$table->string('Nama_Petugas', 50);
			$table->string('No_Telfon', 20);
			$table->string('Divisi', 20);
			$table->bigInteger('Id_Akun')->index('Id_Akun')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_petugas');
	}

}
