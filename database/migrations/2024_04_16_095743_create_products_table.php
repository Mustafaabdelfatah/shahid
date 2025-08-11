<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * products == units
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->double('price');
            $table->enum('paying', ['Installment', 'cash'])->nullable();
            $table->enum('main_category', ['Administrative', 'Residential','Commercial'])->nullable();
            $table->enum('Finishing_type', ['red_bricks', 'finishing_text','super_deluxe','lux'])->nullable();
            $table->enum('Furnished', ['Furnished', 'Unfurnished'])->nullable();
            $table->double('service_charges')->nullable();
            $table->integer('size');
            $table->string('plan')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->tinyInteger('approve')->default(0)->nullable();
            $table->integer('rooms')->nullable()->default(0);
            $table->integer('bathroom')->nullable()->default(0);
            $table->tinyinteger('primum')->nullable()->default(0);
            $table->string('location')->nullable();
            $table->integer('floor')->nullable()->default(0);
            $table->enum('type', ['rent', 'sale'])->nullable();
            $table->date('expairday')->nullable();
            $table->string('video_unit')->nullable();
            $table->tinyInteger('for_sale')->nullable()->default(0);
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->constrained('states')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('cascade');
            $table->foreignId('gates_id')->nullable()->constrained('gates')->onDelete('cascade');
            $table->foreignId('services_id')->nullable()->constrained('services')->onDelete('cascade');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('cascade');
            $table->string('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('updated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
