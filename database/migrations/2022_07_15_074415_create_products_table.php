<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('SKU');
            $table->string('product_name');
            $table->float('price', 9, 2);
            $table->string('short_desc');
            $table->string('img');
            $table->string('sizes');
            $table->string('colors');
            $table->longText('desc');
            $table->string('weight');
            $table->string('dimensions');
            $table->string('materials');
            $table->string('tag');
            $table->string('photo_gallery');
            $table->integer('in_stock');
            $table->integer('status')->default(0);
            $table->integer('category_id');
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
        Schema::dropIfExists('table_products');
    }
};
