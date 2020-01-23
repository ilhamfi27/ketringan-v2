<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbAkunTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_akun', function(Blueprint $table)
		{
			$table->foreign('Id_Group_Access', 'tb_akun_ibfk_1')->references('Id_Group_Access')->on('tb_gaccess')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_akun', function(Blueprint $table)
		{
			$table->dropForeign('tb_akun_ibfk_1');
		});
	}

}
