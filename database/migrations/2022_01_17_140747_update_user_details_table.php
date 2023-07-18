<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('user_details')) {

            if (Schema::hasColumn('user_details', 'gender'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('gender');
                });
            }

            if (Schema::hasColumn('user_details', 'sexual_orientation'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('sexual_orientation');
                });
            }

            if (Schema::hasColumn('user_details', 'race'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('race');
                });
            }

            if (Schema::hasColumn('user_details', 'ethnicity'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('ethnicity');
                });
            }

            if (Schema::hasColumn('user_details', 'ally_groups'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('ally_groups');
                });
            }

            if (Schema::hasColumn('user_details', 'age_range'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('age_range');
                });
            }

            if (Schema::hasColumn('user_details', 'income_range'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('income_range');
                });
            }

            if (Schema::hasColumn('user_details', 'language_proficiency'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('language_proficiency');
                });
            }

            if (Schema::hasColumn('user_details', 'appearance'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('appearance');
                });
            }

            if (Schema::hasColumn('user_details', 'disability'))
            {
                Schema::table('user_details', function (Blueprint $table)
                {
                    $table->dropColumn('disability');
                });
            }

            Schema::table('user_details', function (Blueprint $table) {

                if (!Schema::hasColumn('user_details', 'user_id'))
                {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->unsignedBigInteger('user_id')->nullable()->after('id')->unique();
                        $table->foreign('user_id')->references('id')->on('users');
                    });
                }

                if (!Schema::hasColumn('user_details', 'race_id'))
                {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->unsignedBigInteger('race_id')->nullable()->after('id');
                        $table->foreign('race_id')->references('id')->on('races');
                    });
                }


                if (!Schema::hasColumn('user_details', 'ethnicity_id'))
                {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->unsignedBigInteger('ethnicity_id')->nullable()->after('id');
                        $table->foreign('ethnicity_id')->references('id')->on('ethnicities');

                    });
                }

                if (!Schema::hasColumn('user_details', 'appearance_id'))
                {
                    Schema::table('user_details', function (Blueprint $table)
                    {

                        $table->unsignedBigInteger('appearance_id')->nullable()->after('id');
                        $table->foreign('appearance_id')->references('id')->on('appearances');
                    });
                }


                if (!Schema::hasColumn('user_details', 'language_proficiency_id'))
                {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->unsignedBigInteger('language_proficiency_id')->nullable()->after('id');
                        $table->foreign('language_proficiency_id')->references('id')->on('language_proficiencies');
                    });
                }

                if (!Schema::hasColumn('user_details', 'income_range_id'))
                {
                    Schema::table('user_details', function (Blueprint $table)
                    {

                        $table->unsignedBigInteger('income_range_id')->nullable()->after('id');
                        $table->foreign('income_range_id')->references('id')->on('income_ranges');
                    });
                }

                if (!Schema::hasColumn('user_details', 'age_range_id'))
                {
                    Schema::table('user_details', function (Blueprint $table)
                    {
                        $table->unsignedBigInteger('age_range_id')->nullable()->after('id');
                        $table->foreign('age_range_id')->references('id')->on('age_ranges');
                    });
                }
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
