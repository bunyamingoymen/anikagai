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
        Schema::create('webtoon_episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->string('name');
            $table->unsignedBigInteger('webtoon_code');
            $table->unsignedBigInteger('image')->nullable();
            $table->longText('description')->nullable();;
            $table->integer('episode_short');
            $table->integer('click_count');
            $table->date('publish_date')->default("1970-01-01");
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
        Schema::dropIfExists('webtoon_episodes');
    }
};
