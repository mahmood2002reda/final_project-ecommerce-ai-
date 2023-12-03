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
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('description')->nullable();
            $table->decimal('price',12,2)->unsigned()->default(000.00); //14=>total 2=>places
            $table->string('sku');
            $table->boolean('manage_stock')->default(0);
            $table->integer('qty')->nullable();
            $table->boolean('in_stock')->default(0);
            $table->boolean('is_active');
            $table->foreignId('vendor_brands_id')->constrained('vendor_brands')->cascadeOnUpdate()->cascadeOnDelete();
            $table->softDeletes();
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
