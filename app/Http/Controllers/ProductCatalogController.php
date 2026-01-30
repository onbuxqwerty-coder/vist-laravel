<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    public function index(Request $request, string $type = null)
    {
        if ($type === null) {
            $type = $request->route('type');
        }

        $validTypes = ['workstation', 'server', 'ipc', 'ups'];
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        // Завантажуємо продукти з галереєю та характеристиками
        $products = Product::with([
            'primaryImage',
            'images' => fn($q) => $q->orderBy('sort_order'),
            'specs'  => fn($q) => $q->orderBy('sort_order'),
        ])
            ->active()
            ->where('category', $type)
            ->get();

        $typeNames = [
            'workstation' => 'Робочі станції',
            'server' => 'Серверне обладнання',
            'ipc' => 'Промислові ПК',
            'ups' => 'ДБЖ',
        ];

        return view('products.index', [
            'type' => $type,
            'typeName' => $typeNames[$type] ?? $type,
            'products' => $products,
        ]);
    }

    public function show(string $type = null, $id = null)
    {
        return "Product detail: $type / $id";
    }
}
