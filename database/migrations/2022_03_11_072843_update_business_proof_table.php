<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBusinessProofTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('business_proofs')) {
            Schema::table('business_proofs', function (Blueprint $table) {
                Schema::disableForeignKeyConstraints();
                DB::statement("ALTER TABLE `business_proofs` DROP FOREIGN KEY `business_proofs_business_id_foreign`;");
                DB::statement("ALTER TABLE `business_proofs` DROP INDEX `business_proofs_business_id_unique`");

                $table->string('email', 100)->after('business_id');
                $table->string('phone', 100)->after('business_id');
                $table->unsignedBigInteger('user_id')->after('business_id');
                $table->enum('reject_reason',
                [
                    'Phone Number does not match with Google’s database',
                    'Business Proof file is not clear',
                    'Business Proof document is not sufficient',
                    'Business Email does not match with Google’s database',
                    'Need other kind of Business Proof',
                    'Other'
                ])->after('image')->nullable();
                $table->enum('request_status',
                [
                    'Pending',
                    'Accepted',
                    'Rejected'
                ])->after('image')->default('Pending');
                Schema::enableForeignKeyConstraints();
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
