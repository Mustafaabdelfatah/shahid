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
        Schema::table('unit_installments', function (Blueprint $table) {
            $table->dropColumn('down_payment'); // حذف عمود مقدم
        });
    }
    
    public function down(): void
    {
        Schema::table('unit_installments', function (Blueprint $table) {
            $table->double('down_payment', 8, 2)->nullable(); // إعادة العمود في حالة الرجوع
        });
    }
    
};
