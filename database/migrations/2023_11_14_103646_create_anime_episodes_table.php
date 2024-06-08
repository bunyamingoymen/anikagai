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
        Schema::create('anime_episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('anime_code');
            $table->string('image')->nullable();
            $table->string('video');
            $table->longText('description')->nullable();
            $table->integer('season_short')->default(0);
            $table->integer('episode_short')->default(0);
            $table->integer('click_count')->default(0);
            $table->unsignedInteger('video_minute')->default(0); //
            $table->unsignedInteger('video_second')->default(0); //
            $table->integer('intro_start_time_min')->default(0);
            $table->integer('intro_start_time_sec')->default(0);
            $table->integer('intro_end_time_min')->default(0);
            $table->integer('intro_end_time_sec')->default(5);
            $table->integer('next_episode_time_min')->default(0); //
            $table->integer('next_episode_time_sec')->default(0); //
            $table->tinyInteger('is_url')->default(0); //
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
        Schema::dropIfExists('anime_episodes');
    }
};
