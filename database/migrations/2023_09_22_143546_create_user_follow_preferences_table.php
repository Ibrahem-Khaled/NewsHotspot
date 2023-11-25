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
        Schema::create('user_follow_preferences', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sub_categories_id')->nullable();
            $table->integer('categories_id')->nullable();
            $table->integer('team_id')->nullable();
            $table->integer('source_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_follow_preferences');
    }
};
