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
        Schema::create('webtoon_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->unsignedBigInteger('webtoon_episode_code');
            $table->string('file_type');
            $table->string('file');
            $table->unsignedBigInteger('file_order'); //dosya sırası
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
        Schema::dropIfExists('webtoon_files');
    }
};
