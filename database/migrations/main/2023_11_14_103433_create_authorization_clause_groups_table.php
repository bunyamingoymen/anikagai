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
        Schema::create('authorization_clause_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('code');
            $table->unsignedBigInteger('clause_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('create_user_code')->default(1);
            $table->unsignedBigInteger('update_user_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorization_clause_groups');
    }
};
