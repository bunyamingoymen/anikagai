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
        Schema::create('content_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_code');
            $table->unsignedBigInteger('content_code');
            $table->tinyInteger('content_type'); //0: webtoon, 1: anime
            $table->tinyInteger('is_main')->default(0); //0: Seçilen içeriğin ana kategorisi değil, 1: ana kategorisi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_categories');
    }
};
