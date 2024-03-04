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
        Schema::create('notification_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->string('notification_image')->default('index/img/default/notification.jpg')->nullable();
            $table->string('notification_title');
            $table->longText('notification_text');
            $table->longText('notification_url')->nullable();
            $table->unsignedBigInteger('from_user_code')->nullable(); //0 ise sistem tarafından gönderilmiştir
            $table->unsignedBigInteger('to_user_code'); //0 ise admin arayüzünde, 0 dan farklı lise spesifik kullanıcılar
            $table->date('notification_date')->default("1970-01-02");
            $table->date('notification_end_date')->default("1970-01-01")->nullable();
            $table->tinyInteger('readed')->default(0); // 0: okunmamış, 1: okunmuş
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
        Schema::dropIfExists('notification_users');
    }
};
