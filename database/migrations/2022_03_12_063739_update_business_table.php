<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('businesses')) {
            Schema::table('businesses', function (Blueprint $table) {

            $table->dropColumn('reason_rejected');

            \DB::statement("ALTER TABLE `businesses` CHANGE `claimed` `claimed` ENUM('Unclaimed','Accepted') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unclaimed';");

            $table->string('email', 100)->nullable()->change();
            $table->string('phone', 20)->nullable()->change();
          });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
