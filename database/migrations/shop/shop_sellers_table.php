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
        Schema::connection('shop_mysql')->create('shop_sellers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('show_name')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->Integer('product_count')->default(0);
            $table->longText('description')->nullable();
            $table->string('IBAN')->nullable();
            $table->string('IBAN_Name')->nullable();
            $table->unsignedBigInteger('max_cargo_price')->default(500);
            $table->string('phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('discord')->nullable();
            $table->string('website')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('create_user_code')->default(1);
            $table->unsignedBigInteger('update_user_code')->nullable();
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_sellers');
    }
};
