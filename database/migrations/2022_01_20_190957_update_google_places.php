<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGooglePlaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('google_places')) {
            Schema::table('google_places', function (Blueprint $table) {
                $table->string('opening_hours', 512)->nullable();
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
        if (Schema::hasTable('google_places') && Schema::hasColumn('google_places', 'opening_hours')) {
          Schema::table('google_places', function (Blueprint $table)
          {
              $table->dropColumn('opening_hours');
          });
        }
    }
}
