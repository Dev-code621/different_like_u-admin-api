<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggersLastModified extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fields = [
            'age_range',
            'income_range',
            'language_proficiency',
            'appearance',
            'ethnicity',
            'race',

        ];
        foreach ($fields as $field) {

            DB::unprepared("DROP TRIGGER IF EXISTS `trig_insert_" . $field . "_last_modified`");
            DB::unprepared("CREATE TRIGGER trig_insert_" . $field . "_last_modified BEFORE INSERT ON user_details
            FOR EACH ROW
            BEGIN
               IF   NEW." . $field ."_id IS NOT NULL AND NEW." . $field ."_last_modified IS NULL THEN
                    SET NEW." . $field ."_last_modified = CURRENT_TIMESTAMP;
   	           END IF;
            END
        ");

            DB::unprepared("DROP TRIGGER IF EXISTS `trig_update_" . $field ."_last_modified`");
            DB::unprepared("CREATE TRIGGER trig_update_" . $field ."_last_modified BEFORE UPDATE ON user_details
            FOR EACH ROW
            BEGIN
               IF NEW." . $field ."_id <> OLD." . $field ."_id  THEN
                    SET NEW." . $field ."_last_modified = CURRENT_TIMESTAMP;
               END IF;
            END
        ");
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trig_age_range_last_modified');
        Schema::dropIfExists('trig_income_range_last_modified');
        Schema::dropIfExists('trig_language_proficiency_last_modified');
        Schema::dropIfExists('trig_appearance_last_modified');
        Schema::dropIfExists('trig_ethnicity_last_modified');
        Schema::dropIfExists('trig_race_last_modified');
    }
}
