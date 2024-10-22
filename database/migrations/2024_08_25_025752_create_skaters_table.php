<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skaters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fone')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_estate')->nullable();
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('fk_user');
            $table->foreign('fk_user')->references('id')->on('users');
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
        Schema::dropIfExists('skaters');
    }
}
