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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('image_profile');
            $table->string('mobile_number1');
            $table->string('mobile_number2');
            $table->unsignedBigInteger ('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');

          

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
