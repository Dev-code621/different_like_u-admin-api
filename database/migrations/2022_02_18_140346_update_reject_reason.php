<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRejectReason extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('businesses')) {
            DB::statement("ALTER TABLE `businesses` CHANGE `reason_rejected` `reason_rejected` 
                ENUM('Phone Number does not match with Google’s database',
                    'Business Proof file is not clear',
                    'Business Proof document is not sufficient',
                    'Business Email does not match with Google’s database',
                    'Need other kind of Business Proof',
                    'Other'
                ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
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
