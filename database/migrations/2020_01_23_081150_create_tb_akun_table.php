<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbAkunTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_akun', function(Blueprint $table)
		{
			$table->bigIncrements('Id_Akun');
			$table->string('Username', 50);
			$table->string('Password', 50);
			$table->enum('Role', array('Admin','CPC','CRM','Vendor'));
			$table->enum('Aktifitas_Akun', array('online','offline','',''))->default('offline');
			$table->enum('Status_Akun', array('aktif','nonaktif'));
			$table->timestamp('Created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('Update_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('Delete_at')->nullable();
			$table->bigInteger('Id_Group_Access')->nullable()->index('fk_groupaccess')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_akun');
	}

}
