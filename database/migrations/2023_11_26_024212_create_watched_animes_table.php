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
        //anime ismi ile geçiyor ama hem animeyi hem de webtoon'u kapsıyor
        Schema::create('watched_animes', function (Blueprint $table) {
            $table->id();
            $table->string('anime_code');
            $table->string('anime_episode_code');
            $table->string('content_type'); //0:webtoon,1:anime;
            $table->string('user_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watched_animes');
    }
};
