<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReviewReplyStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('reviews')) {
            Schema::table('reviews', function (Blueprint $table) {
                \DB::statement("ALTER TABLE `reviews` CHANGE `status` `status` ENUM('DRAFT','PUBLISHED', 'UNPUBLISHED', 'PENDING', 'DELETE', 'USER_BANNED') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PUBLISHED';");
                $table->boolean('verified')->default(false)->nullable();

            });
        }
        if (Schema::hasTable('replies')) {
            Schema::table('replies', function (Blueprint $table) {
                \DB::statement("ALTER TABLE `replies` CHANGE `status` `status` ENUM('DRAFT','PUBLISHED', 'UNPUBLISHED', 'PENDING', 'DELETE', 'USER_BANNED') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PUBLISHED';");
                $table->boolean('verified')->default(false)->nullable();

            });
        }
        // \DB::statement("ALTER TABLE `flagged_contents` CHANGE `status` `status` ENUM('Pending','Resolved','Dismiss', 'User banned', 'Deleted deleted') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending';");
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
