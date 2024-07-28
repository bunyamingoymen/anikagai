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
        Schema::create('scored_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_code');
            $table->unsignedBigInteger('content_code');
            $table->unsignedFloat('score', 5, 2);
            $table->tinyInteger('content_type'); //0: webtoon, 1: anime
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scored_contents');
    }
};
