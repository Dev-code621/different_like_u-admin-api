<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastModifiedColumnUserDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            Schema::table('user_details', function (Blueprint $table) {
                if (!Schema::hasColumn('user_details', 'age_range_last_modified')) {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->timestamp('age_range_last_modified')->after('age_range_id')->nullable();

                    });
                }
                if (!Schema::hasColumn('user_details', 'income_range_last_modified')) {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->timestamp('income_range_last_modified')->after('income_range_id')->nullable();

                    });
                }
                if (!Schema::hasColumn('user_details', 'language_proficiency_last_modified')) {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->timestamp('language_proficiency_last_modified')->after('language_proficiency_id')->nullable();

                    });
                }
                if (!Schema::hasColumn('user_details', 'appearance_last_modified')) {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->timestamp('appearance_last_modified')->after('appearance_id')->nullable();

                    });
                }
                if (!Schema::hasColumn('user_details', 'ethnicity_last_modified')) {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->timestamp('ethnicity_last_modified')->after('ethnicity_id')->nullable();

                    });
                }
                if (!Schema::hasColumn('user_details', 'race_last_modified')) {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->timestamp('race_last_modified')->after('race_id')->nullable();

                    });
                }

            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('age_range_last_modified');
            $table->dropColumn('income_range_last_modified');
            $table->dropColumn('language_proficiency_last_modified');
            $table->dropColumn('appearance_last_modified');
            $table->dropColumn('ethnicity_last_modified');
            $table->dropColumn('race_last_modified');
        });
    }
}
