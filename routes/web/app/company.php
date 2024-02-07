<?php

use App\Http\Controllers\CompanyController;

Route::get('company', [CompanyController::class, 'index'])->name('company.update');
