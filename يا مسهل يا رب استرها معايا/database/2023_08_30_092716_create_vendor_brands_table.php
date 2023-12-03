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
        Schema::create('vendor_brands', function (Blueprint $table) {
            $table->id();
            $table->string('brands',150)->unique();
            $table->string('logo');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->enum('active',[0,1])->default(0);
            $table->foreignId('vendor_id')->constrained('vendors')->cascadeOnUpdate()->cascadeOndelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_brands');
    }
};
