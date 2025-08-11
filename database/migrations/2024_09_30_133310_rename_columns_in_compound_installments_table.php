<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('compound_installments', function (Blueprint $table) {
            // Rename 'price' to 'monthly_installment'
            DB::statement('ALTER TABLE compound_installments CHANGE price monthly_installment DECIMAL(8, 2) NOT NULL');
            
            // Rename 'down_payment' to 'deposit'
            DB::statement('ALTER TABLE compound_installments CHANGE down_payment deposit DECIMAL(8, 2) NOT NULL');
        });
    }

    public function down()
    {
        Schema::table('compound_installments', function (Blueprint $table) {
            // Revert 'monthly_installment' to 'price'
            DB::statement('ALTER TABLE compound_installments CHANGE monthly_installment price DECIMAL(8, 2) NOT NULL');
            
            // Revert 'deposit' to 'down_payment'
            DB::statement('ALTER TABLE compound_installments CHANGE deposit down_payment DECIMAL(8, 2) NOT NULL');
        });
    }
};
