<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbMenuDipesanHarianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_menu_dipesan_harian', function(Blueprint $table)
		{
			$table->foreign('Id_Detail_Harian', 'tb_menu_dipesan_harian_ibfk_1')->references('Id_Detail_Harian')->on('tb_detail_harian')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('Id_Menu_Paket', 'tb_menu_dipesan_harian_ibfk_2')->references('Id_Menu_Paket')->on('tb_menu_paket')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_menu_dipesan_harian', function(Blueprint $table)
		{
			$table->dropForeign('tb_menu_dipesan_harian_ibfk_1');
			$table->dropForeign('tb_menu_dipesan_harian_ibfk_2');
		});
	}

}
