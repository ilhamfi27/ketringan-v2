<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSturctureOnQuickOrderMembershipAndPartnership extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE tb_quick_order MODIFY COLUMN `Status` ENUM('menunggu_verifikasi', 'proses_verifikasi', 'selesai', 'dibatalkan') DEFAULT 'menunggu_verifikasi'");
        DB::statement("ALTER TABLE tb_req_membership MODIFY COLUMN `Status_Request` ENUM('menunggu_verifikasi', 'proses_verifikasi', 'selesai', 'dibatalkan') DEFAULT 'menunggu_verifikasi'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE tb_quick_order MODIFY COLUMN `Status` ENUM('belum di acc','acc','dibatalkan')");
        Schema::table('tb_req_membership', function (Blueprint $table) {
            $table->string('Status_Request', 50)
                  ->nullable()
                  ->default(null)
                  ->change();
        });
    }
}
