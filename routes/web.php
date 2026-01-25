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
