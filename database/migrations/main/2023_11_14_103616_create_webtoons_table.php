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
        Schema::create('webtoons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->string('name');
            $table->string('short_name');
            $table->string('poster')->nullable();
            $table->string('thumb_poster')->nullable();
            $table->string('image');
            $table->string('thumb_image')->nullable();
            $table->string('thumb_image_2')->nullable();
            $table->longText('description')->nullable();
            $table->integer('episode_count')->default(0);
            $table->integer('season_count')->default(0);
            $table->integer('average_min')->default(0);
            $table->unsignedBigInteger('main_category')->default(1);
            $table->string('main_category_name')->default("Genel");
            $table->string('date')->default(2000);
            $table->integer('click_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->unsignedBigInteger('scoreUsers')->default(0); //Kaç kişinin oy verdiğini tutar
            $table->unsignedFloat('score', 5, 2)->default(0); //Maksimum 5 olabilir ve virgülden sonra iki basamağı olur.
            $table->tinyInteger('showStatus')->default(0); //0: Herkes görür, 1: Sadece üyeler, 2: Üye olmayanlar sansürlü, 3: Sadece Link, 4: Gizli
            $table->tinyInteger('plusEighteen')->default(1); //0: +18 değil, 1: +18.
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
        Schema::dropIfExists('webtoons');
    }
};
