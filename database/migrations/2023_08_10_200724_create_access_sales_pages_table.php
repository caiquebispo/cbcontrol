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
        Schema::create('access_sales_pages', function (Blueprint $table) {

            $table->increments('id');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->ipAddress()->nullable();
            $table->date('day')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_sales_pages');
    }
};
