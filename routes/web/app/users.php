<?php

use App\Http\Controllers\UserController;

Route::get('user', [UserController::class, 'index'])->name('users.list');
Route::get('users/getAll', [UserController::class, 'getAll'])->name('users.getAll');
