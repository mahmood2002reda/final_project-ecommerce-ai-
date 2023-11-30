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
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description');
            $table->decimal('price',12,2)->unsigned()->default(000.00); //14=>total 2=>places
            $table->unsignedInteger('quantity');
            $table->string('sku');
            $table->boolean('manage_stock')->default(0);
            $table->boolean('is_available')->default(true);
            $table->string('image');
            $table->integer('qty')->nullable();
            $table->boolean('in_stock')->default(0);
            $table->bigInteger('category_id')->constrained()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('brand_id')->constrained();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('is_active');
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