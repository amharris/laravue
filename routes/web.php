<?php

use App\Http\Controllers\Auth\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard', [\App\Http\Controllers\UserController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/redeem', [\App\Http\Controllers\UserController::class, 'redeem'])
//     ->middleware(['auth', 'verified'])->name('redeem');

Route::post('/redeem/{reward}', [\App\Http\Controllers\UserController::class, 'redeem'])
    ->middleware(['auth', 'verified'])->name('redeem.reward');


Route::prefix('admin')->group(function() {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'adminDash'])
        ->middleware(['auth', 'verified', 'verify_admin'])
        ->name('admin.dashboard');

    Route::get('searchItem', [\App\Http\Controllers\Admin\AjaxSearchController::class, 'execute'])
        ->middleware(['auth', 'verified'])
        ->name('search.item.ajax');

    Route::resources([
        'bags' => \App\Http\Controllers\Admin\TransactionBagController::class,
        'points' => \App\Http\Controllers\Admin\RewardPointController::class,
        'rewards' => \App\Http\Controllers\Admin\RewardController::class,
        'users' => \App\Http\Controllers\Admin\UserAdministrationController::class,
    ]);

    Route::resource('transactions', \App\Http\Controllers\Admin\TransactionController::class)
        ->except('create');

    Route::match(['get', 'post'], 'transactions/create', [\App\Http\Controllers\Admin\TransactionController::class, 'create'])
        ->name('transactions.create');

    Route::post('rewards/redeem', [\App\Http\Controllers\Admin\RewardController::class, 'redeem'])
        ->name('rewards.redeem');

    Route::get('users/{user}/rewards', [\App\Http\Controllers\Admin\UserAdministrationController::class, 'rewards'])
        ->name('users.rewards');
});

require __DIR__.'/auth.php';
