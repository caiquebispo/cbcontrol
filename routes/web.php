<?php

use App\Http\Controllers\SubscribeController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\VerifyCsrfToken;
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

Route::redirect('/', '/login')->name('home');

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
Route::prefix('app')->group(base_path('routes/web/app/sales.php'));
Route::prefix('app')->group(base_path('routes/web/app/networks.php'));
Route::prefix('app')->group(base_path('routes/web/app/permissions.php'));
Route::prefix('app')->group(base_path('routes/web/app/systemUsability.php'));
Route::prefix('app')->group(base_path('routes/web/app/boxfront.php'));
Route::prefix('app')->group(base_path('routes/web/app/report.php'));

//STORE ROUTE LINKS
Route::prefix('store')->group(base_path('routes/web/store/home.php'));

Route::get('subscribe', [SubscribeController::class, 'subscribe'])
    ->name('subscribe')
    ->middleware(Authenticate::class);
Route::post('stripe/webhook', [SubscribeController::class, 'handleWebhook'])->name('cashier.webhook')->withoutMiddleware(VerifyCsrfToken::class);

require __DIR__ . '/auth.php';
