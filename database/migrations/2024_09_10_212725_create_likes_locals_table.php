<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes_locals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_local');
            $table->unsignedBigInteger('fk_skater')->unique();

            $table->foreign('fk_local')->references('id')->on('locals');
            $table->foreign('fk_skater')->references('id')->on('skaters');
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
        Schema::dropIfExists('likes_locals');
    }
}
