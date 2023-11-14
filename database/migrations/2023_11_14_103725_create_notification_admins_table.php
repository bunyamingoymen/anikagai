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
        Schema::create('notification_admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->string('notification_title');
            $table->longText('notification_text');
            $table->unsignedBigInteger('from_user_code');
            $table->unsignedBigInteger('to_user_code');
            $table->date('notification_date')->default("1970-01-01");
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
        Schema::dropIfExists('notification_admins');
    }
};
