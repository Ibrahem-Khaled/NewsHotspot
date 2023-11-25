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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->boolean('isAdmin')->default(false);
            $table->integer('google_id')->unique()->nullable();
            $table->integer('apple_id')->unique()->nullable();
            $table->integer('twitter_id')->unique()->nullable();
            $table->integer('facebook_id')->unique()->nullable();
            $table->string('displayname')->nullable();
            $table->string('profile_picture')->nullable();
            $table->date('last_login_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
