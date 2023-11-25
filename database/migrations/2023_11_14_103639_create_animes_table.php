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
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->string('name');
            $table->string('short_name');
            $table->string('image');
            $table->longText('description')->nullable();
            $table->integer('episode_count')->default(0);
            $table->integer('season_count')->default(0);
            $table->integer('average_min')->default(0);
            $table->string('date')->default(2000);
            $table->unsignedBigInteger('main_category')->default(1);
            $table->string('main_category_name')->default("Genel");
            $table->integer('click_count')->default(0);;
            $table->unsignedBigInteger('create_user_code')->default(1);
            $table->unsignedBigInteger('update_user_code')->nullable();
            $table->tinyInteger('deleted')->default(0); // 0: silinmemiş, aktif, görünür. 1: silinmiş, pasif, görünmez
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
