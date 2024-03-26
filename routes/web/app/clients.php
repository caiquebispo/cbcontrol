<?php

use App\Http\Controllers\ClientController;

Route::get('clients', [ClientController::class, 'index']);
Route::get('clients/caroline', [ClientController::class, 'caroline']);
Route::get('clients/exportPDF', [ClientController::class, 'exportPDF']);
Route::get('clients/getAll', [ClientController::class, 'getAll'])->name('client.getAll');
