<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->enum('theme', [1, 2, 3])->nullable();
            $table->boolean('top_stories_notification')->nullable();
            $table->boolean('sports_notification')->nullable();
            $table->boolean('match_schedule_notifications')->nullable();
            $table->boolean('subscribe_to_email_notification')->nullable();
            $table->boolean('autoplay_video')->nullable();
            $table->bigInteger('font_size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
