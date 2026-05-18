<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:web,admin,support'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/perfil/{type}/{id}', [DashboardController::class, 'show'])->name('perfil');
    Route::get('/exportar-csv', [DashboardController::class, 'exportCSV'])->name('exportar.csv');
    Route::post('/store/{type}', [DashboardController::class, 'store'])->name('store');
    Route::post('/update/{type}/{id}', [DashboardController::class, 'update'])->name('update');
});
