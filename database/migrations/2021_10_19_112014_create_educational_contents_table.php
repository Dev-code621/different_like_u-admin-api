<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_contents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('description', 512);
            $table->enum('status', ['DRAFT', 'PUBLISHED', 'UNPUBLISHED']);
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
        Schema::dropIfExists('educational_contents');
    }
}
