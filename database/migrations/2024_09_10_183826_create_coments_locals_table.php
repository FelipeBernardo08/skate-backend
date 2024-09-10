<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentsLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coments_locals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_skater');
            $table->unsignedBigInteger('fk_local');
            $table->text('coment');
            $table->string('date');

            $table->foreign('fk_skater')->references('id')->on('skaters');
            $table->foreign('fk_local')->references('id')->on('locals');
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
        Schema::dropIfExists('coments_locals');
    }
}
