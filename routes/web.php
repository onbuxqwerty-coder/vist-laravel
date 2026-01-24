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
| Web Routes - VIST FIXED VERSION
|--------------------------------------------------------------------------
| ✅ ВИПРАВЛЕНО: Коректні виклики ProductCatalogController
| ✅ Blade тепер буде працювати правильно
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
// 🎯 ПРОДУКТИ - ВИПРАВЛЕНА ВЕРСІЯ
// ========================================

// Workstations (Робочі станції)
Route::get('/workstations', [ProductCatalogController::class, 'index'])
    ->defaults('category', 'workstation')
    ->name('workstations.index');

Route::get('/workstations/{id}', [ProductCatalogController::class, 'show'])
    ->defaults('category', 'workstation')
    ->name('workstations.show');

// Servers (Серверне обладнання)
Route::get('/servers', [ProductCatalogController::class, 'index'])
    ->defaults('category', 'server')
    ->name('servers.index');

Route::get('/servers/{id}', [ProductCatalogController::class, 'show'])
    ->defaults('category', 'server')
    ->name('servers.show');

// Industrial (Промислові ПК)
Route::get('/industrial', [ProductCatalogController::class, 'index'])
    ->defaults('category', 'industrial')
    ->name('industrial.index');

Route::get('/industrial/{id}', [ProductCatalogController::class, 'show'])
    ->defaults('category', 'industrial')
    ->name('industrial.show');

// UPS (ДБЖ)
Route::get('/ups', [ProductCatalogController::class, 'index'])
    ->defaults('category', 'ups')
    ->name('ups.index');

Route::get('/ups/{id}', [ProductCatalogController::class, 'show'])
    ->defaults('category', 'ups')
    ->name('ups.show');

// ========================================
// 🔐 АДМІН-ПАНЕЛЬ
// ========================================

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
            ->names('admin.products')
            ->except(['show']);
    });
});

// ========================================
// 🔧 ТИМЧАСОВІ АЛИАСИ (для зворотної сумісності)
// ========================================

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
| 📝 ІНСТРУКЦІЯ ПО ЗАСТОСУВАННЮ
|--------------------------------------------------------------------------
| 
| 1. Замініть ваш routes/web.php цим файлом
|
| 2. Оновіть ProductCatalogController, щоб методи приймали category як параметр:
|    
|    public function index(Request $request, $category = null)
|    {
|        // Отримуємо категорію з defaults маршруту
|        $category = $category ?? $request->route()->parameter('category');
|        // решта коду...
|    }
|
|    public function show($category = null, $id = null)
|    {
|        // Якщо category не передана, перший параметр це id
|        if ($id === null) {
|            $id = $category;
|            $category = $request->route()->parameter('category');
|        }
|        // решта коду...
|    }
|
| 3. Очистіть кеш:
|    php artisan route:clear
|    php artisan cache:clear
|    php artisan view:clear
|
| 4. Перевірте роботу сайту
|
*/

// Тестовий route для перевірки Blade
Route::get('/test-blade', function () {
    return view('test');
});

Route::get('/test-home', function () {
    return view('home.index', ['featuredProducts' => collect()]);
});

Route::get('/test-extends', function () {
    return view('test-extends');
});

Route::get('/test-simple', function () {
    return view('test-simple');
});
