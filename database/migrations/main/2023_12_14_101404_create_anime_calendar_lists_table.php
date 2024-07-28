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
        Schema::create('anime_calendar_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->unsignedBigInteger('anime_calendar_code');
            $table->unsignedBigInteger('calendar_order');
            $table->date("date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anime_calendar_lists');
    }
};
