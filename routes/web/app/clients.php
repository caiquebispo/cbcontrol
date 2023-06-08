<?php

use App\Http\Controllers\ClientController;

Route::get('clients', [ClientController::class, 'index'])->name('clients');