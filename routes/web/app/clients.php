<?php

use App\Http\Controllers\ClientController;

Route::get('clients', [ClientController::class, 'index'])->name('clients');
Route::get('clients/exportPDF', [ClientController::class, 'exportPDF'])->name('exportPDF');
