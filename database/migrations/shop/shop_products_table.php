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
        Schema::connection('shop_mysql')->create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('seller_code'); //satıcı kodu 1 ise ana satıcı satmaktadır. Anikagai 1 dir.
            $table->string('url');
            $table->string('name');
            $table->string('price');
            $table->string('priceType')->default('TRY');
            $table->longText('description')->nullable();
            $table->tinyInteger('is_trend')->default(0);
            $table->tinyInteger('score')->default(0);
            $table->unsignedBigInteger('reviewCount')->default(0);
            $table->unsignedBigInteger('stock')->default(0);
            $table->integer('cargo_day')->default(3);
            $table->string('cargo_company')->default('');
            $table->unsignedBigInteger('create_user_code')->default(1);
            $table->unsignedBigInteger('update_user_code')->nullable();
            $table->tinyInteger('is_approved')->default(0);
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_products');
    }
};
