<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbPengembalianDanaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_pengembalian_dana', function(Blueprint $table)
		{
			$table->foreign('Id_Pesanan', 'tb_pengembalian_dana_ibfk_1')->references('Id_Pesanan')->on('tb_pesanan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_pengembalian_dana', function(Blueprint $table)
		{
			$table->dropForeign('tb_pengembalian_dana_ibfk_1');
		});
	}

}
