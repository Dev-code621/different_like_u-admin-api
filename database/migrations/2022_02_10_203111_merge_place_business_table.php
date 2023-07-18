<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MergePlaceBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('google_places');
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('opening_hours', 512)->nullable();
            $table->string('default_address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('types');
            $table->string('international_phone_number');
            $table->string('url');
            $table->string('website')->nullable();
        });
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
