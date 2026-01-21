<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCatalogController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes - VIST TEMPORARY FIX VERSION
|--------------------------------------------------------------------------
| ✅ Додано тимчасові алиаси для products.* routes
| ⚠️  Після знаходження проблеми - замінити на оптимізовану версію
*/

// ========================================
// Головна та інформаційні сторінки
// ========================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// ========================================
// Підтримка та контакти
// ========================================

Route::prefix('support')->name('support.')->group(function () {
    Route::get('/', [SupportController::class, 'index'])->name('index');
    Route::post('/', [SupportController::class, 'submit'])->name('submit');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ========================================
// 🎯 ПРОДУКТИ - З тимчасовими алиасами
// ========================================

// Workstations
Route::get('/workstations', function() {
    return app(ProductCatalogController::class)->index(request(), 'workstation');
})->name('workstations.index');

Route::get('/workstations/{id}', function($id) {
    return app(ProductCatalogController::class)->show('workstation', $id);
})->name('workstations.show');

// Servers
Route::get('/servers', function() {
    return app(ProductCatalogController::class)->index(request(), 'server');
})->name('servers.index');

Route::get('/servers/{id}', function($id) {
    return app(ProductCatalogController::class)->show('server', $id);
})->name('servers.show');

// Industrial
Route::get('/industrial', function() {
    return app(ProductCatalogController::class)->index(request(), 'industrial');
})->name('industrial.index');

Route::get('/industrial/{id}', function($id) {
    return app(ProductCatalogController::class)->show('industrial', $id);
})->name('industrial.show');

// UPS
Route::get('/ups', function() {
    return app(ProductCatalogController::class)->index(request(), 'ups');
})->name('ups.index');

Route::get('/ups/{id}', function($id) {
    return app(ProductCatalogController::class)->show('ups', $id);
})->name('ups.show');

// Адмін-панель
Route::prefix('admin')->middleware(['admin.ip'])->group(function () {

    // 1. Публічні маршрути (Аутентифікація)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // 2. Захищені маршрути (тільки для авторизованих адмінів)
    Route::middleware(['admin.auth'])->group(function () {
        
        // Специфічні маршрути для продуктів (мають бути ПЕРЕД ресурсним контролером)
        Route::post('products/update-statuses', [ProductController::class, 'updateStatuses'])
            ->name('products.update-statuses');

        Route::patch('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
            ->name('products.toggle-status');

        // Ресурсний контролер (керує index, create, store, edit, update, destroy)
        Route::resource('products', ProductController::class)
            ->names('admin.products') // Додає префікс admin до імен маршрутів (напр. admin.products.index)
            ->except(['show']);
        
        // ... інші маршрути
    });
});

// ========================================
// 🔧 ТИМЧАСОВІ АЛИАСИ (видалити після виправлення)
// ========================================

/*
 * ⚠️  ЦІ МАРШРУТИ - ТИМЧАСОВІ!
 * Вони створені щоб сайт працював поки ви шукаєте де використовується
 * старе ім'я route('products.workstations')
 * 
 * ПІСЛЯ знаходження та виправлення всіх входжень - ВИДАЛІТЬ цю секцію!
 */

Route::get('/fake-route-products-workstations', function() {
    return redirect()->route('workstations.index', [], 301);
})->name('products.workstations');

Route::get('/fake-route-products-servers', function() {
    return redirect()->route('servers.index', [], 301);
})->name('products.servers');

Route::get('/fake-route-products-industrial', function() {
    return redirect()->route('industrial.index', [], 301);
})->name('products.industrial');

Route::get('/fake-route-products-ups', function() {
    return redirect()->route('ups.index', [], 301);
})->name('products.ups');

// Для show routes
Route::get('/fake-route-products-workstations/{id}', function($id) {
    return redirect()->route('workstations.show', $id, 301);
})->name('products.workstations.show');

Route::get('/fake-route-products-servers/{id}', function($id) {
    return redirect()->route('servers.show', $id, 301);
})->name('products.servers.show');

Route::get('/fake-route-products-industrial/{id}', function($id) {
    return redirect()->route('industrial.show', $id, 301);
})->name('products.industrial.show');

Route::get('/fake-route-products-ups/{id}', function($id) {
    return redirect()->route('ups.show', $id, 301);
})->name('products.ups.show');

// ========================================
// 🔄 REDIRECTS (зворотна сумісність URL)
// ========================================

Route::redirect('/products/workstations', '/workstations', 301);
Route::redirect('/products/servers', '/servers', 301);
Route::redirect('/products/ipc', '/industrial', 301);
Route::redirect('/products/ups', '/ups', 301);

/*
|--------------------------------------------------------------------------
| 📝 ЩО РОБИТИ ДАЛІ
|--------------------------------------------------------------------------
| 
| 1. Після заміни цього файлу запустіть:
|    php artisan route:clear
|    php artisan cache:clear
|
| 2. Перевірте чи працює сайт
|
| 3. ЗНАЙДІТЬ де використовується route('products.workstations'):
|    grep -r "products\.workstations" resources/views/
|    grep -r "products\.workstations" app/Http/Controllers/
|
| 4. ЗАМІНІТЬ всі входження на нові назви:
|    products.workstations → workstations.index
|    products.servers      → servers.index
|    і т.д.
|
| 5. ВИДАЛІТЬ секцію "ТИМЧАСОВІ АЛИАСИ" з цього файлу
|
| 6. ЗАМІНІТЬ цей файл на оптимізовану версію (web_optimized.php)
|
*/