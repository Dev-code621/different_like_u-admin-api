<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlaggedContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flagged_contents', function (Blueprint $table) {
            $table->id();
            $table->enum('reason', ['TBD1', 'TBD2', 'TBD3'])->default('TBD1');
            $table->enum('status', ['PENDING', 'RESOLVED', 'OTHER'])->default('PENDING');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->enum('type', ['REVIEW', 'MERCHANT_REPLY']);
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flagged_contents');
    }
}
