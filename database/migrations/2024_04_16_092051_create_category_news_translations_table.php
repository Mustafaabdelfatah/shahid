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
        Schema::create('category_news_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_news_id');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->unique(['category_news_id', 'locale']);
            $table->foreign('category_news_id')->references('id')->on('category_news')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_news_translations');
    }
};
