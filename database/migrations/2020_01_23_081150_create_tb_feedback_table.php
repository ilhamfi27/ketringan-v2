<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_feedback', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Feedback');
			$table->bigInteger('Id_Konsumen')->index('Id_Konsumen')->unsigned();
			$table->bigInteger('Id_Menu_Paket')->index('Id_Menu_Paket')->unsigned();
			$table->string('Komentar', 100);
			$table->integer('Rating');
			$table->timestamp('Tanggal_Feedback')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->enum('Status_Feedback', array('show','hidden','',''))->default('show');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_feedback');
	}

}
