<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WorkstationController extends Controller
{
    /**
     * Display a listing of workstation products.
     */
    public function index(Request $request)
    {
        // Базовий запит для робочих станцій
        $query = Product::with([
            'images' => fn($q) => $q->orderBy('sort_order'),
            'specs' => fn($q) => $q->orderBy('sort_order')
        ])
        ->where('is_active', true)
        ->where('category', 'workstation');

        // Фільтрація по ціні
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Фільтрація по наявності
        if ($request->filled('in_stock')) {
            $query->where('in_stock', true);
        }

        // Сортування
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        $query->orderBy($sortBy, $sortOrder);

        // Отримуємо продукти
        $products = $query->get();

        // Підготовка даних для кожного продукту
        $products->each(function ($product) {
            // Ключові характеристики для картки (CPU, RAM, GPU, Storage)
            $product->key_specs = $product->specs
                ->whereIn('spec_key', ['CPU', 'RAM', 'GPU', 'Storage'])
                ->take(4);
            
            // Головне зображення
            $product->main_image = $product->images->first()?->image ?? 'img/placeholder-product.jpg';
            
            // Всі характеристики для детальної панелі
            $product->all_specs = $product->specs;
        });

        return view('workstations.index', [
            'products' => $products,
            'pageTitle' => 'Робочі станції | VIST'
        ]);
    }

    /**
     * Display the specified workstation product.
     */
    public function show(string $id)
    {
        $product = Product::with([
            'images' => fn($q) => $q->orderBy('sort_order'),
            'specs' => fn($q) => $q->orderBy('sort_order'),
            'configurations.specs' => fn($q) => $q->orderBy('sort_order'),
            'documents' => fn($q) => $q->orderBy('sort_order'),
            'related' => fn($q) => $q->with('images')
        ])
        ->where('category', 'workstation')
        ->findOrFail($id);

        return view('workstations.show', [
            'product' => $product,
            'pageTitle' => $product->title . ' | VIST'
        ]);
    }
}
