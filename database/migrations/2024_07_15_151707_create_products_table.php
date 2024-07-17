<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('thumbnail');

            $table->integer('category_id');
            $table->integer('sub_category_id')->nullable();
            $table->integer('child_category_id')->nullable();;

            $table->integer('brand_id');
            $table->integer('quantity');

            $table->text('description');
            $table->text('details');

            $table->string('sku')->nullable();
            $table->double('price')->nullable();
            $table->double('discount_price')->nullable();
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();
            $table->string('product_type')->nullable();
            $table->boolean('is_top')->nullable();
            $table->boolean('is_best')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('status');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
