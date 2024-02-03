<?php

use App\Http\Controllers\BoxFrontController;

Route::get('/app/boxfront', [BoxFrontController::class, 'index'])->name('boxfront');
