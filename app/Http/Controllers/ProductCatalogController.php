<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * ProductCatalogController - Оптимізована версія
 * 
 * Змінено з closure в routes на окремі методи для підтримки route:cache
 */
class ProductCatalogController extends Controller
{
    /**
     * Конфігурація категорій
     */
    private const CATEGORIES = [
        'workstation' => [
            'type' => 'workstation',
            'title' => 'Робочі станції VIST',
            'subtitle' => 'Професійні системи для CAD, BIM, 3D та інженерії',
            'description' => 'Високопродуктивні робочі станції для інженерних застосувань',
            'empty_icon' => '💻',
            'view' => 'products.catalog',
        ],
        'server' => [
            'type' => 'server',
            'title' => 'Сервери VIST',
            'subtitle' => 'Надійні серверні рішення для бізнесу',
            'description' => 'Корпоративні сервери для віртуалізації та баз даних',
            'empty_icon' => '🖥️',
            'view' => 'products.catalog',
        ],
        'industrial' => [
            'type' => 'ipc',
            'title' => 'Промислові комп\'ютери',
            'subtitle' => 'Надійні системи для промисловості',
            'description' => 'Fanless IPC для SCADA, MES та автоматизації',
            'empty_icon' => '🏭',
            'view' => 'products.catalog',
        ],
        'ups' => [
            'type' => 'ups',
            'title' => 'ДБЖ та системи живлення',
            'subtitle' => 'Безперебійне живлення для критичних систем',
            'description' => 'ДБЖ та системи резервного живлення',
            'empty_icon' => '⚡',
            'view' => 'products.catalog',
        ],
    ];

    // ========================================
    // WORKSTATIONS
    // ========================================

    /**
     * Каталог робочих станцій
     */
    public function indexWorkstations(Request $request): View
    {
        return $this->index($request, 'workstation');
    }

    /**
     * Деталі робочої станції
     */
    public function showWorkstation(int $id): View
    {
        return $this->show('workstation', $id);
    }

    // ========================================
    // SERVERS
    // ========================================

    /**
     * Каталог серверів
     */
    public function indexServers(Request $request): View
    {
        return $this->index($request, 'server');
    }

    /**
     * Деталі сервера
     */
    public function showServer(int $id): View
    {
        return $this->show('server', $id);
    }

    // ========================================
    // INDUSTRIAL
    // ========================================

    /**
     * Каталог промислових ПК
     */
    public function indexIndustrial(Request $request): View
    {
        return $this->index($request, 'industrial');
    }

    /**
     * Деталі промислового ПК
     */
    public function showIndustrial(int $id): View
    {
        return $this->show('industrial', $id);
    }

    // ========================================
    // UPS
    // ========================================

    /**
     * Каталог ДБЖ
     */
    public function indexUps(Request $request): View
    {
        return $this->index($request, 'ups');
    }

    /**
     * Деталі ДБЖ
     */
    public function showUps(int $id): View
    {
        return $this->show('ups', $id);
    }

    // ========================================
    // PRIVATE HELPER METHODS
    // ========================================

    /**
     * Універсальний метод для відображення каталогу
     * 
     * @param Request $request
     * @param string $category (workstation|server|industrial|ups)
     * @return View
     */
    public function index(Request $request, string $category): View
    {
        $config = self::CATEGORIES[$category] ?? abort(404);
        
        // Запит продуктів з оптимізацією (eager loading)
        $products = Product::with(['images', 'specs'])
            ->where('category', $config['type'])
            ->where('is_active', 1)
            ->orderBy('title')
            ->paginate(12);

        // НЕ перетворюємо в масив - передаємо об'єкти як є
        // Blade очікує об'єкти Product з відношеннями images і specs

        return view($config['view'], [
            'products' => $products,
            'category' => $category,
            'config' => $config,
            'pageTitle' => $config['title'],
        ]);
    }

    /**
     * Універсальний метод для відображення деталей продукту
     * 
     * @param string $category
     * @param int $id
     * @return View
     */
    public function show(string $category, int $id): View
    {
        $config = self::CATEGORIES[$category] ?? abort(404);

        $product = Product::with([
            'images' => function($query) {
                $query->orderBy('sort_order');
            },
            'specs' => function($query) {
                $query->orderBy('sort_order');
            },
        ])
        ->where('category', $config['type'])
        ->findOrFail($id);

        return view('products.show', [
            'product' => $product,
            'category' => $category,
            'config' => $config,
            'pageTitle' => $product->title,
        ]);
    }

    /**
     * Отримати route name для типу продукту
     * 
     * @param string $productType
     * @return string
     */
    private function getCategoryRoute(string $productType): string
    {
        return match($productType) {
            'workstation' => 'workstations',
            'server' => 'servers',
            'ipc' => 'industrial',
            'ups' => 'ups',
            default => 'products',
        };
    }
}