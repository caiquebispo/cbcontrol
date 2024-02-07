<?php

use App\Http\Controllers\SystemUsabilityController;

Route::get('systemUsability', [SystemUsabilityController::class, 'index'])->name('systemUsability.list');
Route::get('systemUsability/getDataTable', [SystemUsabilityController::class, 'getDataTable']);
Route::get('systemUsability/getDataGraphs', [SystemUsabilityController::class, 'getDataGraphs']);
