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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('color_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('material_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('price');
            $table->integer('discount');
            $table->integer('stock');
            $table->integer('star');
            $table->enum('status',['active','inactive']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
