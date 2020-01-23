<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbSaranVendorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_saran_vendor', function(Blueprint $table)
		{
			$table->string('Nama_Vendor', 100);
			$table->string('No_Telepon', 15);
			$table->string('Email', 100);
			$table->text('Alamat', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_saran_vendor');
	}

}
