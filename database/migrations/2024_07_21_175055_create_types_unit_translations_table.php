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
        Schema::create('types_unit_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('types_unit_id');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->foreign('types_unit_id')->references('id')->on('types_units')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types_unit_translations');
    }
};
