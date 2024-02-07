<?php

use App\Http\Controllers\CategoryController;

Route::get('categories', [CategoryController::class, 'index'])->name('categories.list');
