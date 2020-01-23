<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbKomplainTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_komplain', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Komplain');
			$table->bigInteger('Id_Konsumen')->index('fk_konsumen')->unsigned();
			$table->string('Subjek_Komplain', 50);
			$table->text('isi_komplain', 65535);
			$table->timestamp('tanggal_komplain')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->enum('Status_Tanggapan', array('belum','sudah','',''))->default('belum');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_komplain');
	}

}
