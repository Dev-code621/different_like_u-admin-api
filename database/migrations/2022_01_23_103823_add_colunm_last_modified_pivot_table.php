<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunmLastModifiedPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ally_group_user_detail', function (Blueprint $table) {
            if (!Schema::hasColumn('ally_group_user_detail', 'last_modified')) {
                Schema::table('ally_group_user_detail', function (Blueprint $table)
                {
                    $table->timestamp('last_modified')->nullable();

                });
            }
        });
        Schema::table('disability_user_detail', function (Blueprint $table) {
            if (!Schema::hasColumn('disability_user_detail', 'last_modified')) {
                Schema::table('disability_user_detail', function (Blueprint $table)
                {
                    $table->timestamp('last_modified')->nullable();

                });
            }
        });
        Schema::table('gender_user_detail', function (Blueprint $table) {
            if (!Schema::hasColumn('gender_user_detail', 'last_modified')) {
                Schema::table('gender_user_detail', function (Blueprint $table)
                {
                    $table->timestamp('last_modified')->nullable();

                });
            }
        });
        Schema::table('sexual_orientation_user_detail', function (Blueprint $table) {
            if (!Schema::hasColumn('sexual_orientation_user_detail', 'last_modified')) {
                Schema::table('sexual_orientation_user_detail', function (Blueprint $table)
                {
                    $table->timestamp('last_modified')->nullable();

                });
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ally_group_user_detail', function (Blueprint $table) {
            if (Schema::hasColumn('ally_group_user_detail', 'last_modified')) {
                Schema::table('ally_group_user_detail', function (Blueprint $table)
                {
                    $table->dropColumn('last_modified');

                });
            }
        });
        Schema::table('disability_user_detail', function (Blueprint $table) {
            if (Schema::hasColumn('disability_user_detail', 'last_modified')) {
                Schema::table('disability_user_detail', function (Blueprint $table)
                {
                    $table->dropColumn('last_modified');

                });
            }
        });
        Schema::table('gender_user_detail', function (Blueprint $table) {
            if (Schema::hasColumn('gender_user_detail', 'last_modified')) {
                Schema::table('gender_user_detail', function (Blueprint $table)
                {
                    $table->dropColumn('last_modified');

                });
            }
        });
        Schema::table('sexual_orientation_user_detail', function (Blueprint $table) {
            if (Schema::hasColumn('sexual_orientation_user_detail', 'last_modified')) {
                Schema::table('sexual_orientation_user_detail', function (Blueprint $table)
                {
                    $table->dropColumn('last_modified');

                });
            }
        });
    }
}
