<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEnums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `flagged_contents` CHANGE `status` `status` ENUM('Pending','Resolved','Dismiss', 'User banned', 'Post deleted') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending';");
        \DB::statement("ALTER TABLE `flagged_contents` CHANGE `type` `type` ENUM('Review','Merchant reply','Consumer reply') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");

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
