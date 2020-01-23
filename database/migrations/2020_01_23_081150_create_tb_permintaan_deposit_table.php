<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPermintaanDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_permintaan_deposit', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Permintaan');
			$table->bigInteger('Id_Vendor')->index('Id_Vendor')->unsigned();
			$table->integer('Nominal_Deposit');
			$table->enum('Jenis_Permintaan', array('tarik','tambah'));
			$table->enum('Status_Permintaan', array('belum_diproses','diproses','selesai','dibatalkan'))->default('belum_diproses');
			$table->text('Bukti_Transfer', 65535)->nullable();
			$table->timestamp('Waktu_Permintaan')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_permintaan_deposit');
	}

}
