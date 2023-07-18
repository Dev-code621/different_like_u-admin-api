<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigAgeRangeLastModifiedPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fields = [
            'ally_group',
            'disability',
            'gender',
            'sexual_orientation',

        ];
        foreach ($fields as $field) {

            DB::unprepared("DROP TRIGGER IF EXISTS `trig_insert_" . $field . "_last_modified`");
            DB::unprepared("CREATE TRIGGER trig_insert_" . $field . "_last_modified BEFORE INSERT ON ". $field ."_user_detail
            FOR EACH ROW
            BEGIN
               IF   NEW." . $field ."_id IS NOT NULL AND NEW.last_modified IS NULL THEN
                    SET NEW.last_modified = CURRENT_TIMESTAMP;
   	           END IF;
            END
        ");

            DB::unprepared("DROP TRIGGER IF EXISTS `trig_update_" . $field ."_last_modified`");
            DB::unprepared("CREATE TRIGGER trig_update_" . $field ."_last_modified BEFORE UPDATE ON ". $field ."_user_detail
            FOR EACH ROW
            BEGIN
               IF NEW." . $field ."_id <> OLD." . $field ."_id  THEN
                    SET NEW.last_modified = CURRENT_TIMESTAMP;
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
        Schema::dropIfExists('trig_age_range_last_modified_pivot');
    }
}
