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
        Schema::create('index_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('deleted')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('index_users');
    }
};
