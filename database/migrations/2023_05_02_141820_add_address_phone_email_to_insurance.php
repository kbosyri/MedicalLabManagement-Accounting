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
        if(!Schema::hasColumn('insurances','address')
        && !Schema::hasColumn('insurances','phone')
        && !Schema::hasColumn('insurances','email'))
        {
            Schema::table('insurances', function (Blueprint $table) {
                $table->text('address');
                $table->text('phone');
                $table->text('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insurances', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('email');
        });
    }
};
