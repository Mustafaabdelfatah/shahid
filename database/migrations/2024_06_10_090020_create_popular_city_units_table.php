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
        Schema::create('popular_city_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('popular_city_id')->nullable()->constrained('popular_cities')->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popular_city_units');
    }
};
