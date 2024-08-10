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
        Schema::connection('shop_mysql')->create('shop_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->string('name');
            $table->string('surname');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image');
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('create_user_code')->default(1);
            $table->unsignedBigInteger('update_user_code')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_users');
    }
};
