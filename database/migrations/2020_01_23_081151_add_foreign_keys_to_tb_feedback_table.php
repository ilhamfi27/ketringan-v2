<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_feedback', function(Blueprint $table)
		{
			$table->foreign('Id_Konsumen', 'tb_feedback_ibfk_1')->references('Id_Konsumen')->on('tb_konsumen')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('Id_Menu_Paket', 'tb_feedback_ibfk_2')->references('Id_Menu_Paket')->on('tb_menu_paket')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_feedback', function(Blueprint $table)
		{
			$table->dropForeign('tb_feedback_ibfk_1');
			$table->dropForeign('tb_feedback_ibfk_2');
		});
	}

}
