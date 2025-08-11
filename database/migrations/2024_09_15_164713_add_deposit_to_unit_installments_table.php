<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('unit_installments', function (Blueprint $table) {
            $table->double('deposit', 8, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('unit_installments', function (Blueprint $table) {
            $table->dropColumn('deposit');
        });
    }

};
