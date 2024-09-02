<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('announcement_type');
            $table->text('description');
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('fk_type_product');
            $table->unsignedBigInteger('fk_subtype_product');
            $table->unsignedBigInteger('fk_skater');

            $table->foreign('fk_subtype_product')->references('id')->on('subtype_products');
            $table->foreign('fk_type_product')->references('id')->on('type_products');
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
        Schema::dropIfExists('products');
    }
}
