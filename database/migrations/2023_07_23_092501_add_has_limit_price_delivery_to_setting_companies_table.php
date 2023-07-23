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
        Schema::table('setting_companies', function (Blueprint $table) {
            $table->float('has_limit_price_delivery')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_companies', function (Blueprint $table) {
            $table->dropColumn('has_limit_price_delivery');
        });
    }
};
