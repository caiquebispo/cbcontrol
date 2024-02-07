<?php

use App\Http\Controllers\BoxFrontController;

Route::get('/boxfront', [BoxFrontController::class, 'index'])->name('boxfront');
