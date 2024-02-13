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

            $table->tinyInteger('is_test_mode')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting_companies', function (Blueprint $table) {

            $table->dropColumn('is_test_mode');
        });
    }
};
