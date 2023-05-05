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
        if(!Schema::hasColumn('patient_debts','is_paid'))
        {
            Schema::table('patient_debts', function (Blueprint $table) {
                $table->boolean('is_paid')->default(false);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_debts', function (Blueprint $table) {
            $table->dropColumn('is_paid');
        });
    }
};
