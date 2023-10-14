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

//PANEL ROUTE LINKS
Route::prefix('app')->group(base_path('routes/web/app/dashboard.php'));
Route::prefix('app')->group(base_path('routes/web/app/profiles.php'));
Route::prefix('app')->group(base_path('routes/web/app/groups.php'));
Route::prefix('app')->group(base_path('routes/web/app/clients.php'));
Route::prefix('app')->group(base_path('routes/web/app/users.php'));
Route::prefix('app')->group(base_path('routes/web/app/notify.php'));
Route::prefix('app')->group(base_path('routes/web/app/company.php'));
Route::prefix('app')->group(base_path('routes/web/app/category.php'));
Route::prefix('app')->group(base_path('routes/web/app/product.php'));
Route::prefix('app')->group(base_path('routes/web/app/networks.php'));
Route::prefix('app')->group(base_path('routes/web/app/sales.php'));

//STORE ROUTE LINKS
Route::prefix('store')->group(base_path('routes/web/store/home.php'));




require __DIR__.'/auth.php';
