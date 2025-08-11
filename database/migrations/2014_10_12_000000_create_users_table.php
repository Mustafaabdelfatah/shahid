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
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('agency_image')->nullable();
            $table->text('bio')->nullable();
            $table->enum('role', ['unit_onwer','broker', 'client', 'agency','employee'])->default('client');
            $table->tinyInteger('status')->default(1);
            $table->string('city')->nullable();
            $table->string('company_name')->nullable();
            $table->string('website_link')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('commercial_registration_no')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('telegram')->nullable();
            $table->string('github')->nullable();
            $table->string('vimeo')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('map')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
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
