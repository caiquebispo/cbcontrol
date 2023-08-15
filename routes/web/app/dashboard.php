<?php

use App\Http\Controllers\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/getDataGraphSales', [DashboardController::class, 'getDataGraphSales']);
Route::get('/dashboard/getDataTableSales', [DashboardController::class, 'getDataTableSales']);
Route::get('/dashboard/getDataGraphSalesForCategories', [DashboardController::class, 'getDataGraphSalesForCategories']);
Route::get('/dashboard/getDataTableSalesForCategories', [DashboardController::class, 'getDataTableSalesForCategories']);
Route::get('/dashboard/getDataIndicators', [DashboardController::class, 'getDataIndicators']);
