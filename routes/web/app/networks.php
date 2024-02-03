<?php

use App\Http\Controllers\NetworkController;

Route::get('networks', [NetworkController::class, 'index'])->name('networks');
