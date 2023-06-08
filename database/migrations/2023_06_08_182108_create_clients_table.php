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
        Schema::create('clients', function (Blueprint $table) {
           
            $table->id();
            $table->string('full_name');
            $table->string('number_phone')->nullable()->unique();
            $table->float('value');
            $table->string('payment_method')->nullable();
            $table->string('local')->nullable();
            $table->string('delivery')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
