<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('businesses')) {

            DB::statement("ALTER TABLE businesses ADD COLUMN reason_rejected ENUM('Edit my Verification Request',
                        'Business proof document is not clear',
                        'Business proof document is not sufficient',
                        'Other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL;");

            DB::statement("ALTER TABLE businesses MODIFY COLUMN claimed ENUM('Pending',
                        'Accepted',
                        'Rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending';");
            Schema::table('businesses', function (Blueprint $table) {
                $table->timestamp("claimed_on")->nullable();
            });

        }
        if (Schema::hasTable('business_proof')) {
            Schema::rename('business_proof', 'business_proofs');
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
