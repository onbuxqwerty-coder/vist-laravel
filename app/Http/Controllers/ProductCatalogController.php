<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    /**
     * Показати каталог продуктів
     * Використовує один view для всіх категорій: resources/views/products/index.blade.php
     * 
     * @param Request $request
     * @param string|null $category - Отримується з route()->defaults()
     */
    public function index(Request $request, string $category = null)
    {
        // Отримуємо категорію з defaults маршруту, якщо не передана явно
        if ($category === null) {
            $category = $request->route()->parameter('category');
        }
        
        // Валідація категорії
        $validCategories = ['workstation', 'server', 'industrial', 'ups'];
        if (!in_array($category, $validCategories)) {
            abort(404, "Категорія '{$category}' не знайдена");
        }
        
        // Отримуємо продукти з усіма зв'язками + ціни
        $products = Product::with(['images', 'specs', 'prices'])
            ->active()
            ->where('category', $category)
            ->get();
        
        // Для кожного продукту отримуємо актуальну ціну
        $products->each(function ($product) {
            $product->active_price = $product->getActivePrice();
            $product->formatted_price = $product->getFormattedPrice();
            $product->has_promo = $product->hasActivePromo();
        });
        
        // Назви категорій для відображення
        $categoryNames = [
            'workstation' => 'Робочі станції',
            'server' => 'Серверне обладнання',
            'industrial' => 'Промислові ПК',
            'ups' => 'ДБЖ',
        ];
        
        // ✅ Використовуємо ОДИН view для всіх категорій
        return view('products.index', [
            'category' => $category,
            'categoryName' => $categoryNames[$category] ?? $category,
            'products' => $products,
        ]);
    }
    
    /**
     * Показати детальну сторінку продукту
     * Використовує один view для всіх категорій: resources/views/products/show.blade.php
     * 
     * @param string|null $category - Отримується з route()->defaults()
     * @param string|int $id - Може бути ID або slug
     */
    public function show(string $category = null, $id = null)
    {
        // Якщо category не передана, отримуємо з маршруту
        if ($category === null) {
            $category = request()->route()->parameter('category');
        }
        
        // Якщо id не передано, значить category це насправді id
        if ($id === null && $category !== null && !in_array($category, ['workstation', 'server', 'industrial', 'ups'])) {
            $id = $category;
            $category = request()->route()->parameter('category');
        }
        
        // Валідація категорії
        $validCategories = ['workstation', 'server', 'industrial', 'ups'];
        if (!in_array($category, $validCategories)) {
            abort(404, "Категорія '{$category}' не знайдена");
        }
        
        // Шукаємо продукт за ID або slug
        $query = Product::with(['images', 'specs', 'prices'])
            ->where('category', $category)
            ->active();
        
        // Визначаємо чи це ID чи slug
        if (is_numeric($id)) {
            $product = $query->where('id', $id)->firstOrFail();
        } else {
            $product = $query->where('slug', $id)->firstOrFail();
        }
        
        // Отримуємо детальну інформацію про ціни
        $activePriceData = $product->getActivePrice();
        $allPrices = $product->prices()->active()->get();
        
        // Назви категорій для відображення
        $categoryNames = [
            'workstation' => 'Робочі станції',
            'server' => 'Серверне обладнання',
            'industrial' => 'Промислові ПК',
            'ups' => 'ДБЖ',
        ];
        
        // ✅ Використовуємо ОДИН view для всіх категорій
        return view('products.show', [
            'product' => $product,
            'activePriceData' => $activePriceData,
            'allPrices' => $allPrices,
            'category' => $category,
            'categoryName' => $categoryNames[$category] ?? $category,
        ]);
    }
}