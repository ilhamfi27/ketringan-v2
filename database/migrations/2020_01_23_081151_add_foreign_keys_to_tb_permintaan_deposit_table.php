<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTbPermintaanDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_permintaan_deposit', function(Blueprint $table)
		{
			$table->foreign('Id_Vendor', 'tb_permintaan_deposit_ibfk_1')->references('Id_Vendor')->on('tb_vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_permintaan_deposit', function(Blueprint $table)
		{
			$table->dropForeign('tb_permintaan_deposit_ibfk_1');
		});
	}

}
