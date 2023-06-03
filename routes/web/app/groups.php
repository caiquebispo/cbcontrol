<?php

use App\Http\Controllers\GroupController;

Route::get('groups', [GroupController::class, 'index'])->name('groups');