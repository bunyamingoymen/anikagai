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
        Schema::connection('shop_mysql')->create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('order_code');
            $table->string('user_code');
            $table->Integer('product_count')->default(0);
            $table->tinyInteger('is_approved')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->date('order_date');
            $table->date('estimated_date');
            $table->tinyInteger('is_archive')->default(0);
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_orders');
    }
};
