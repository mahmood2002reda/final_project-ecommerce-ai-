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
        Schema::create('product_offer', function (Blueprint $table) {
            $table->id();
            $table->decimal('special_price',12,2)->unsigned();
            $table->enum('special_price_type',['fixed','percent']);
            $table->date('special_price_start');
            $table->date('special_price_end');
            $table->foreignId('product_id')->constrained('products')->cascadeOnUpdate()->cascadeOndelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_offer');
    }
};
