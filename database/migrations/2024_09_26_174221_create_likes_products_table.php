<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_product');
            $table->unsignedBigInteger('fk_skater');

            $table->foreign('fk_product')->references('id')->on('products');
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
        Schema::dropIfExists('likes_products');
    }
}
