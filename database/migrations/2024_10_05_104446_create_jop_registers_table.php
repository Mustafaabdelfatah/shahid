<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()  
    {  
        Schema::create('jop_registers', function (Blueprint $table) {  
            $table->id();  
            $table->string('first_name')->nullable();  
            $table->string('last_name')->nullable();  
            $table->string('contact_number')->nullable();  
            $table->string('email')->nullable();  
            $table->integer('notice_period')->nullable();  
            $table->string('work_link')->nullable();  
            $table->string('resume')->nullable();  
            $table->decimal('current_salary', 10, 2)->nullable();  
            $table->decimal('expected_salary', 10, 2)->nullable();  
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');  
            $table->timestamps();  
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jop_registers');
    }
};
