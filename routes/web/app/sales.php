<?php

use App\Http\Controllers\SalesController;

Route::get('sales', [SalesController::class, 'index'])->name('sales.list');
Route::get('sales/getDataGraphPizza', [SalesController::class, 'getDataGraphPizza']);
Route::get('sales/getDataResumeTableSales', [SalesController::class, 'getDataResumeTableSales']);
