<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbDetailHarianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_detail_harian', function(Blueprint $table)
		{
			$table->foreign('Id_Pesanan', 'tb_detail_harian_ibfk_1')->references('Id_Pesanan')->on('tb_pesanan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('Id_Region', 'tb_detail_harian_ibfk_2')->references('Id_Region')->on('tb_region')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_detail_harian', function(Blueprint $table)
		{
			$table->dropForeign('tb_detail_harian_ibfk_1');
			$table->dropForeign('tb_detail_harian_ibfk_2');
		});
	}

}
