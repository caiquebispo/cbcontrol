<?php

use App\Http\Controllers\PermissionController;

Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');