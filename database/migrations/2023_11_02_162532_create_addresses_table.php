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
        Schema::create('addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->foreign('profile_id')->references('id')->on('profiles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};