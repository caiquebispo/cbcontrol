<?php

use App\Http\Controllers\GroupController;

Route::get('groups', [GroupController::class, 'index'])->name('groups');
Route::get('groups/updateGroupsClients', [GroupController::class, 'updateGroupsClients']);
