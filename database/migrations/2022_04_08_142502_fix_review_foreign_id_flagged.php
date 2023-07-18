<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixReviewForeignIdFlagged extends Migration
{
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('flagged_contents', function (Blueprint $table) {
//            $table->dropForeign('flagged_review_id');
            $table->unsignedBigInteger('review_id')->nullable()->change();
            $table->foreign('review_id', 'flagged_review_id')->references('id')->on('reviews');
        });
        Schema::enableForeignKeyConstraints();
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
