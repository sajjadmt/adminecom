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
        Schema::table('cart_lists', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            $table->dropForeign(['color_id']);
            $table->dropColumn('color_id');
            $table->dropForeign(['size_id']);
            $table->dropColumn(['size_id']);
            $table->dropColumn('total_price');

            $table->unsignedBigInteger('variant_id')->after('user_id');
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('price');
            $table->enum('status',['pending','completed','cancelled','failed','expired'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_lists', function (Blueprint $table) {
            //
        });
    }
};
