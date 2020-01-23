<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbSaranTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_saran', function(Blueprint $table)
		{
			$table->string('Nama', 100);
			$table->string('Email', 50);
			$table->integer('Ratting')->nullable();
			$table->text('Isi_Saran', 65535);
			$table->timestamp('Tanggal_Saran')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_saran');
	}

}
