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
        Schema::create('category_service_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_service_id');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->foreign('category_service_id')->references('id')->on('category_services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_service_translations');
    }
};
