<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');//
            $table->string('slug');//
            $table->mediumText('small_description')->nullable();//
            $table->longText('description')->nullable();//
            $table->integer('original_price');
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnUpdate()->cascadeOnDelete();//
            $table->integer('quantity')->nullable();//
            $table->string('sku')->nullable();//
            $table->tinyInteger('trending')->default('0')->comment('1=trending,0=not-trending');//
            $table->tinyInteger('active')->default('1')->comment('1=visible,0=hidden');//
            $table->string('meta_title')->nullable();//
            $table->mediumText('meta_keyword')->nullable();//
            $table->mediumText('meta_description')->nullable();//
            $table->string('model_image')->nullable();
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

