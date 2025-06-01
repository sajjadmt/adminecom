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
        Schema::table('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->enum('remark', ['new', 'sale', 'featured', 'out_of_stock'])->after('brand_id');
            $table->text('short_description')->nullable()->after('slug');
            $table->longText('long_description')->nullable()->after('short_description');
            $table->integer('weight')->nullable()->after('long_description');
            $table->integer('length')->nullable()->after('weight');
            $table->integer('height')->nullable()->after('length');
            $table->integer('width')->nullable()->after('height');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
