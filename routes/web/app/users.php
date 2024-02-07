<?php

use App\Http\Controllers\UserController;

Route::get('user', [UserController::class, 'index'])->name('users.list');
