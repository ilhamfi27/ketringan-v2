<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbDetailHarianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_detail_harian', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Detail_Harian');
			$table->bigInteger('Id_Pesanan')->index('fk')->unsigned();
			$table->string('Nama_Pemesan', 50)->nullable();
			$table->integer('Jml_Hari_Langganan');
			$table->date('Tanggal_Mulai');
			$table->date('Tanggal_Selesai')->nullable();
			$table->enum('Waktu_Antar', array('p','s','m','psm','ps','pm','sm'));
			$table->bigInteger('Id_Region')->nullable()->index('fk_region')->unsigned();
			$table->text('Catatan', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_detail_harian');
	}

}
