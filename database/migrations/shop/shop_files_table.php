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
        Schema::connection('shop_mysql')->create('shop_files', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('parent_code');
            $table->string('name');
            $table->string('path');
            $table->string('type'); //img, file
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('create_user_code')->default(1);
            $table->unsignedBigInteger('update_user_code')->nullable();
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_files');
    }
};
