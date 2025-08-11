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
        Schema::create('rejected_product_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rejected_id');
            $table->string('locale')->index();
            $table->string('message')->nullable();
            $table->unique(['rejected_id', 'locale']);
            $table->foreign('rejected_id')->references('id')->on('rejected_products')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejected_product_translations');
    }
};
