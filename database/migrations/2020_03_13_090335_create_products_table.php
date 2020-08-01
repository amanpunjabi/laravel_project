<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('price')->nullable();
            // $table->string('special_price')->nullable();
            $table->text('description')->nullable();
            $table->string('status');
            $table->boolean('recommended')->default(0);
            $table->foreign('brand_id')->references('id')->on('brands');
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
        Schema::drop('products');
    }
}
