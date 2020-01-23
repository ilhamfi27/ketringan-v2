<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbMenuDipesanHarianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_menu_dipesan_harian', function(Blueprint $table)
		{
			$table->bigIncrements('Id');
			$table->bigInteger('Id_Detail_Harian')->index('fk')->unsigned();
			$table->date('Tanggal_Antar');
			$table->bigInteger('Id_Menu_Paket')->index('fk_menu')->unsigned();
			$table->text('Catatan', 65535)->nullable();
			$table->enum('Waktu_Antar', array('p','s','m'));
			$table->enum('Status_Pengiriman', array('0','1'))->default('0');
			$table->bigInteger('Id_Kurir')->nullable()->index('fk_kurir')->unsigned();
			$table->string('Penanggungjawab', 50)->nullable();
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
		Schema::drop('tb_menu_dipesan_harian');
	}

}
