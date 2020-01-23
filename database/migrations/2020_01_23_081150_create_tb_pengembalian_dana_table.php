<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPengembalianDanaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_pengembalian_dana', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Pengembalian');
			$table->bigInteger('Id_Pesanan')->index('fk_pesanana')->unsigned();
			$table->text('Nama_Penerima', 65535);
			$table->text('Nama_Bank', 65535);
			$table->text('No_Rekening', 65535);
			$table->dateTime('Tanggal_Pengembalian');
			$table->integer('Nominal_Uang');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_pengembalian_dana');
	}

}
