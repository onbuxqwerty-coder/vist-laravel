<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCatalogController;

// Головна сторінка
Route::get('/', [HomeController::class, 'index'])->name('home');

// Про компанію
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Контакти
Route::view('/contact', 'contact.index')->name('contact');

// Підтримка
Route::view('/support', 'support.index')->name('support.index');

// Каталоги продуктів
Route::get('/workstations', [ProductCatalogController::class, 'index'])
    ->defaults('type', 'workstation')
    ->name('workstations.index');

Route::get('/servers', [ProductCatalogController::class, 'index'])
    ->defaults('type', 'server')
    ->name('servers.index');

Route::get('/industrial', [ProductCatalogController::class, 'index'])
    ->defaults('type', 'industrial')
    ->name('industrial.index');

Route::get('/ups', [ProductCatalogController::class, 'index'])
    ->defaults('type', 'ups')
    ->name('ups.index');

// Auth Routes
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (захищені)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
