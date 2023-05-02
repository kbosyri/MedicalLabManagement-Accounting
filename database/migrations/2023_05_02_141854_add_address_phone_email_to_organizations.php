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
        if(!Schema::hasColumn('organizations','address')
        && !Schema::hasColumn('organizations','phone')
        && !Schema::hasColumn('organizations','email'))
        {
            Schema::table('organizations', function (Blueprint $table) {
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
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('email');
        });
    }
};
