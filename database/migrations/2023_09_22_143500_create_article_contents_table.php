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
        Schema::create('article_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('article_id')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('link')->nullable();
            $table->text('image')->nullable();
            $table->text('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_contents');
    }
};
