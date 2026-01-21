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
        // Отримуємо featured продукти для головної (можна додати scope)
        $featuredProducts = Product::with(['primaryImage', 'specs'])
            ->active()
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
