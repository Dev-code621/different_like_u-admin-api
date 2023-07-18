<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users') ;
            $table->string('title');
            $table->string('content');
            $table->string('summary')->nullable();
            $table->enum('status', ['DRAFT', 'PUBLISHED', 'UNPUBLISHED'])->default('DRAFT');
            $table->enum('category', [
                'UNCONSCIOUS_BIAS',
                'INCLUSIVE_COMMUNICATION_AND_MARKETING',
                'ANTI_DISCRIMINATION_RESOURCES',
                'DIVERSE_AND_INCLUSIVE_TEAMS',
                'CONSUMER_TRENDS',
                'MAXIMIZING_YOUR_DATA',
            ]);
            $table->string('thumbnail')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
