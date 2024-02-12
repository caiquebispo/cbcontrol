<?php

use App\Http\Controllers\ReportController;

Route::get('report', [ReportController::class, 'index']);
