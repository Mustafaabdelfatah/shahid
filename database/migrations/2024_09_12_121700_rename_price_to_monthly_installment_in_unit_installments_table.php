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
            $table->renameColumn('price', 'monthly_installment'); // تغيير اسم العمود إلى monthly_installment
        });
    }
    
    public function down(): void
    {
        Schema::table('unit_installments', function (Blueprint $table) {
            $table->renameColumn('monthly_installment', 'price'); // إعادة الاسم القديم في حالة التراجع
        });
    }
    
};
