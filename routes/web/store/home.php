<?php

use App\Http\Controllers\Store\HomeController;

Route::get('/{slug}', [HomeController::class, 'index']);
