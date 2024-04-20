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
        Schema::create('like_content_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_code');
            $table->unsignedBigInteger('content_episode_code');
            $table->unsignedBigInteger('comment_code');
            $table->tinyInteger('content_type'); //0:webtoon,1:anime;
            $table->tinyInteger('like_type'); //0: unlike, 1:like
            $table->unsignedBigInteger('user_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('like_content_users');
    }
};
