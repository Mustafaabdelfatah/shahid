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
        Schema::create('gates_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gates_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->foreign('gates_id')->references('id')->on('gates')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gates_translations');
    }
};
