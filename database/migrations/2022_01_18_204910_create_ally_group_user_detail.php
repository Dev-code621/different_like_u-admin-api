<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllyGroupUserDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ally_group_user_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ally_group_id');
            $table->unsignedBigInteger('user_detail_id');

            $table->foreign('ally_group_id')
                ->references('id')
                ->on('ally_groups')
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
        Schema::dropIfExists('ally_group_user_detail');
    }
}
