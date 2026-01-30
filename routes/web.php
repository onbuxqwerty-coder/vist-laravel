<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCatalogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AppealController;
use App\Http\Controllers\ContactController;

// Головна сторінка
Route::get('/', [HomeController::class, 'index'])->name('home');

// Про компанію
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Контакти
Route::view('/contact', 'contact.index')->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

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
    ->defaults('type', 'ipc')
    ->name('industrial.index');

Route::get('/ups', [ProductCatalogController::class, 'index'])
    ->defaults('type', 'ups')
    ->name('ups.index');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Admin Routes (захищені)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::resource('products', ProductController::class);

    // Appeals (звернення)
    Route::get('appeals', [AppealController::class, 'index'])->name('appeals.index');
    Route::get('appeals/{appeal}', [AppealController::class, 'show'])->name('appeals.show');
    Route::get('appeals/{appeal}/edit', [AppealController::class, 'edit'])->name('appeals.edit');
    Route::put('appeals/{appeal}', [AppealController::class, 'update'])->name('appeals.update');
    Route::delete('appeals/{appeal}', [AppealController::class, 'destroy'])->name('appeals.destroy');
    Route::post('appeals/{appeal}/comments', [AppealController::class, 'addComment'])->name('appeals.addComment');
    Route::post('appeals/{appeal}/reply', [AppealController::class, 'reply'])->name('appeals.reply');
});
