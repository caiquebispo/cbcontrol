<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::prefix('app')->group(base_path('routes/web/app/dashboard.php'));
Route::prefix('app')->group(base_path('routes/web/app/profiles.php'));
Route::prefix('app')->group(base_path('routes/web/app/groups.php'));


require __DIR__.'/auth.php';
