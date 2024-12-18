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
        Schema::connection('shop_mysql')->create('earned_values', function (Blueprint $table) {
            $table->id();
            $table->string('seller_code');
            $table->string('product_code');
            $table->string('order_code');
            $table->string('price');
            $table->string('commission_rate'); //Yüzde kaç komisyon
            $table->String('commission'); // Hesaplanmış komisyon: price * commission_rate / 100
            $table->string('shipping_to_be_paid'); //Ödenmesi gereken kargo
            $table->string('paid_shipping'); //Ödenen Kargo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earned_values');
    }
};
