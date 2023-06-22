<?php

use App\Http\Controllers\CategoryController;

Route::get('catgories', [CategoryController::class, 'index'])->name('categories.list');