<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGooglePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_places', function (Blueprint $table) {
            $table->id();
            $table->string('default_address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('place_id')->unique();
            $table->string('name');
            $table->string('types');
            $table->string('international_phone_number');
            $table->string('url');
            $table->string('website')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_places');
    }
}
