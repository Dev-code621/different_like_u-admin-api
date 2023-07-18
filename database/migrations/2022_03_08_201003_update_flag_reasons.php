<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFlagReasons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE flagged_contents MODIFY COLUMN reason ENUM('Racist language',
                'Harassment or bullying',
                'Spam',
                'Sexist slurs',
                'Hate speech or symbols',
                'Nudity or Pornography',
                'Violence or threat of violence',
                'Self injury', 
                'Sale or promotion of firearms',
                'Sale or promotion of drugs',
                'Fraud / Fake Information',
                'Vulgarity / Foul language',
                'Inappropriate Photo') DEFAULT 'Racist language'");


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
