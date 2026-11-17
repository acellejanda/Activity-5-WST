<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', fn (Blueprint $table) => $table->foreign('user_id')->references('id')->on('user1s')->cascadeOnDelete());
        Schema::table('addresses', fn (Blueprint $table) => $table->foreign('user_id')->references('id')->on('user1s')->cascadeOnDelete());
        Schema::table('order_products', fn (Blueprint $table) => $table->foreign('product_id')->references('id')->on('product1s')->cascadeOnDelete());
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user1s')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('product1s')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', fn (Blueprint $table) => $table->dropForeign(['user_id']));
        Schema::table('addresses', fn (Blueprint $table) => $table->dropForeign(['user_id']));
        Schema::table('order_products', fn (Blueprint $table) => $table->dropForeign(['product_id']));
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);
        });
    }
};
