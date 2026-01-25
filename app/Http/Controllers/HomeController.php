<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Головна сторінка
     */
    public function index(): View
    {
        // Отримуємо 6 випадкових продуктів для головної
        $featuredProducts = Product::active()
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('home.index', [
            'featuredProducts' => $featuredProducts,
        ]);
    }

    /**
     * Сторінка про компанію
     */
    public function about(): View
    {
        return view('about.index');
    }
}
