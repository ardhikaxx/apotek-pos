<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Apoteker;

// Auth
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', Admin\UserController::class);
    Route::resource('categories', Admin\CategoryController::class);
    Route::resource('products', Admin\ProductController::class);
    Route::post('products/{product}/stock', [Admin\ProductController::class, 'addStock'])->name('products.stock');

    Route::get('transactions/search-product', [Admin\TransactionController::class, 'searchProduct'])->name('transactions.search');
    Route::get('transactions/{transaction}/pdf', [Admin\TransactionController::class, 'printPdf'])->name('transactions.pdf');
    Route::resource('transactions', Admin\TransactionController::class)->only(['index','create','store','show']);

    Route::get('reports', [Admin\ReportController::class, 'index'])->name('reports');
    Route::get('reports/pdf', [Admin\ReportController::class, 'exportPdf'])->name('reports.pdf');
});

// Apoteker Routes
Route::middleware(['auth', 'role:apoteker'])->prefix('apoteker')->name('apoteker.')->group(function () {
    Route::get('dashboard', [Apoteker\DashboardController::class, 'index'])->name('dashboard');

    Route::get('pos', [Apoteker\PosController::class, 'index'])->name('pos');
    Route::post('pos', [Apoteker\PosController::class, 'store'])->name('pos.store');
    Route::get('pos/search-product', [Apoteker\PosController::class, 'searchProduct'])->name('pos.search');
    Route::get('pos/{transaction}', [Apoteker\PosController::class, 'show'])->name('pos.show');
    Route::get('pos/{transaction}/pdf', [Apoteker\PosController::class, 'printPdf'])->name('pos.pdf');

    Route::resource('products', Apoteker\ProductController::class)->only(['index', 'show']);
    Route::post('products/{product}/stock', [Apoteker\ProductController::class, 'addStock'])->name('products.stock');

    Route::get('reports', [Apoteker\ReportController::class, 'index'])->name('reports');
    Route::get('reports/pdf', [Apoteker\ReportController::class, 'exportPdf'])->name('reports.pdf');
});
