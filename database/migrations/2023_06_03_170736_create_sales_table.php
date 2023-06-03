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
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()
            ->references('id')->on('companies')
            ->nullable();
            $table->integer('user_id')->unsigned()
            ->references('id')->on('users')
            ->nullable();
            $table->integer('client_id')->unsigned()
            ->references('id')->on('users')
            ->nullable();
            $table->integer('product_id')->unsigned()
            ->references('id')->on('products')
            ->nullable();
            $table->float('price_sales');
            $table->integer('delivery_method');
            $table->integer('type_sales');
            $table->tinyInteger('payment_state')->default(0); //se foi pago ou não!
            $table->tinyInteger('price_change')->default(0); //teve mudanção de preço?
            $table->tinyInteger('is_add')->default(0); //é uma acrescimo?
            $table->tinyInteger('is_percentage')->default(0); // a variação é em porcentagem?
            $table->float('value_variation_price')->default(0); // qual valor da variação?
            $table->date('sales_date');
            $table->date('payment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
