<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbKlaimItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_klaim_item', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Klaim');
			$table->timestamp('Tanggal_Klaim')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->bigInteger('Id_Konsumen')->index('fk_konsumen')->unsigned();
			$table->bigInteger('Id_Item_Poin')->index('fk_item_poin')->unsigned();
			$table->string('Status', 40)->nullable();
			$table->text('Keterangan', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_klaim_item');
	}

}
