<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbPetugasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_petugas', function(Blueprint $table)
		{
			$table->foreign('Id_Akun', 'tb_petugas_ibfk_1')->references('Id_Akun')->on('tb_akun')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_petugas', function(Blueprint $table)
		{
			$table->dropForeign('tb_petugas_ibfk_1');
		});
	}

}
