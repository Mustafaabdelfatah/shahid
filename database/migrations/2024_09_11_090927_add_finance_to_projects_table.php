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
        Schema::table('projects', function (Blueprint $table) {
            $table->tinyInteger('finance')->default(0)->nullable();
            $table->string('address')->nullable();
            $table->string('map')->nullable();
            $table->year('delivery_date')->nullable();
            $table->enum('construction_status', ['under_construction', 'sent_delivered'])->nullable();
            $table->enum('method_payment', ['cash_money', 'installment','cash_and_insatllment'])->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('cascade');
            $table->enum('finish_type', ['core_and_shell', 'half_finished', 'fully_finished'])->nullable();
            $table->string('spaces')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['finance', 'address', 'map', 'delivery_date', 'spaces', 'construction_status', 'method_payment', 'price', 'created_by', 'finish_type']);
        });
    }
};
