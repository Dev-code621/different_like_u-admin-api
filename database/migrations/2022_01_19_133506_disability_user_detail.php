<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DisabilityUserDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disability_user_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disability_id');
            $table->unsignedBigInteger('user_detail_id');

            $table->foreign('disability_id')
                ->references('id')
                ->on('disabilities')
                ->onDelete('cascade');

            $table->foreign('user_detail_id')
                ->references('id')
                ->on('user_details')
                ->onDelete('cascade');
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
