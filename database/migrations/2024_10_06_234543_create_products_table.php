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
            $table->foreignId('sub_category_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('remark_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('price');
            $table->string('special_price');
            $table->string('image');
            $table->string('star');
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
