<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin Login Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Routes requiring authentication
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Products (Admin only)
    Route::middleware(['role:admin'])->prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Stock In (Admin & Staff Gudang)
    Route::middleware(['role:admin,staff_gudang'])->prefix('stock-in')->name('stockin.')->group(function () {
        Route::get('/', [StockInController::class, 'index'])->name('index');
        Route::get('/create', [StockInController::class, 'create'])->name('create');
        Route::post('/', [StockInController::class, 'store'])->name('store');
        Route::get('/{stockIn}/edit', [StockInController::class, 'edit'])->name('edit');
        Route::put('/{stockIn}', [StockInController::class, 'update'])->name('update');
        Route::delete('/{stockIn}', [StockInController::class, 'destroy'])->name('destroy');
    });

    // Stock Out (Admin & Staff Gudang)
    Route::middleware(['role:admin,staff_gudang'])->prefix('stock-out')->name('stockout.')->group(function () {
        Route::get('/', [StockOutController::class, 'index'])->name('index');
        Route::get('/create', [StockOutController::class, 'create'])->name('create');
        Route::post('/', [StockOutController::class, 'store'])->name('store');
        Route::get('/{stockOut}/edit', [StockOutController::class, 'edit'])->name('edit');
        Route::put('/{stockOut}', [StockOutController::class, 'update'])->name('update');
        Route::delete('/{stockOut}', [StockOutController::class, 'destroy'])->name('destroy');
    });

    // Transactions (Admin & Kasir)
    Route::middleware(['role:admin,kasir'])->prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/create', [TransactionController::class, 'create'])->name('create');
        Route::post('/', [TransactionController::class, 'store'])->name('store');
        Route::get('/{transaction}/edit', [TransactionController::class, 'edit'])->name('edit');
        Route::put('/{transaction}', [TransactionController::class, 'update'])->name('update');

        // Delete only for Admin
        Route::delete('/{transaction}', [TransactionController::class, 'destroy'])
            ->middleware('role:admin')
            ->name('destroy');
    });

    // Reports (Admin & Kasir)
    Route::middleware(['role:admin,kasir'])->prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');

        // Only Kasir can add notes
        Route::post('/add-note', [ReportController::class, 'addNote'])
            ->middleware('role:kasir')
            ->name('addNote');
    });

});
