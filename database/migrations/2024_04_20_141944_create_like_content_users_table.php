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
            $table->string('content_code');
            $table->string('content_episode_code');
            $table->string('comment_code');
            $table->string('content_type'); //0:webtoon,1:anime;
            $table->tinyInteger('like_type'); //0: unlike, 1:like
            $table->string('user_code');
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
