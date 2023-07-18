<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersUserDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('user_details', 'first_name'))
        {
            Schema::table('user_details', function (Blueprint $table)
            {
                $table->dropColumn('first_name');
                $table->dropColumn('last_name');

            });
            Schema::table('users', function (Blueprint $table) {
                $table->string('name', 100)->after('id');
                $table->string('last_name', 100)->after('name')->nullable();
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
