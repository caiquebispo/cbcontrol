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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('company_id')->unsigned()
            ->references('id')->on('companies')
            ->nullable()
            ->onDelete('set null');
            $table->string('number_phone')->nullable()->unique();
            $table->string('number_phone_alternative')->nullable();
            $table->string('cpf')->nullable();
            $table->string('birthday')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
