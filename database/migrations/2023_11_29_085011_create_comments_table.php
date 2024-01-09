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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->unsignedBigInteger('content_code');
            $table->tinyInteger('content_type'); //0:webtoon, 1 anime;
            $table->tinyInteger('comment_type'); //0: ana yorum 1: bir yoruma cevap
            $table->unsignedBigInteger('comment_top_code')->nullable(); //0: Herhangi bir yorumun altında değil, Diğer: Hangi yorumun altında olduğu
            $table->unsignedBigInteger('comment_short')->default(1); //yorum sırası. Eğer comment type 1 ise üst yoruma göre sıralama, comment_type 0 ise ana oyuna göre sıralama
            $table->longText('message');
            $table->unsignedBigInteger('user_code'); //yorum yapan kullanıcı
            $table->date('date')->default('1970-01-01'); //yorumun yapıldığı tarih
            $table->tinyInteger('is_pinned')->default(0); //Yorumun yukarı sabitlenip sabitlenmediğini belritiyor.
            $table->tinyInteger('is_spoiler')->default(0); //spoiler olup olmadığını belirtir
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
