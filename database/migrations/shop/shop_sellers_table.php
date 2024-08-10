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
            $table->unsignedBigInteger('code');
            $table->string('show_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image');
            $table->Integer('product_count');
            $table->longText('description')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('discord')->nullable();
            $table->string('website')->nullable();
            $table->tinyInteger('is_active')->default(2);
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
