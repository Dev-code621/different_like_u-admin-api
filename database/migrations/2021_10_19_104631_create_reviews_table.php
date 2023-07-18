<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses');
            $table->string('comment', 240);
            $table->enum('status', ['DRAFT', 'PUBLISHED', 'UNPUBLISHED'])->default('DRAFT');
            $table->json('images')->nullable();
            $table->float('overall_score');
            $table->float('inclusive_score');
            $table->boolean('welcomed');
            $table->boolean('respectfully');
            $table->boolean('recommended');
            $table->boolean('treated_differently');
            $table->string('treated_differently_reason', 240)->nullable();
            $table->boolean('similarity');
            $table->string('similarity_reason', 240)->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
