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
        Schema::create('webtoon_calendars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->unsignedBigInteger('webtoon_code');
            $table->longText('description')->nullable();;
            $table->date('first_date')->default("1970-01-01");
            $table->integer('cycle_type')->default(0); //0: tekrarlamaz, 1: günlük, 2: haftalık, 3: aylık, 4: yıllık, 5:özel
            $table->integer("special_type")->nullable(); //1: günlük, 2: haftalık, 3: aylık, 4: yıllık
            $table->integer("special_count")->nullable(); //specila_type'a göre kaç sefer sonra olacağını belirler(special_type 1 ise ve buraya 30 yazdıysa 30 günde 1 olur. special type 2 ise ve buraya 2 yazarsa 2 haftada bir olur)
            $table->date('end_date')->nullable();
            $table->string("background_color")->default("#007BFF");
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
        Schema::dropIfExists('webtoon_calendars');
    }
};
