<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSexualOrientationUserDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sexual_orientation_user_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sexual_orientation_id');
            $table->unsignedBigInteger('user_detail_id');

            $table->foreign('sexual_orientation_id')
                ->references('id')
                ->on('sexual_orientations')
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
        Schema::dropIfExists('sexual_orientation_user_detail');
    }
}
