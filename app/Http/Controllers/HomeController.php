<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class HomeController extends Controller
{
    public function index(): View
    {
        SEOMeta::setTitle('ТОВ фірма "ВІСТ" — Комп\'ютери для бізнесу та життя');
        SEOMeta::setDescription('Постачання серверів, робочих станцій, промислових ПК та ДБЖ у Дніпрі. Сервісний центр. Офіційні постачальники Intel, NVIDIA, APC, Eaton.');
        SEOMeta::setKeywords(['сервери Дніпро', 'робочі станції', 'промислові ПК', 'ДБЖ APC Eaton', 'комп\'ютери для бізнесу', 'VIST']);
        OpenGraph::setTitle('ТОВ фірма "ВІСТ" — Комп\'ютери для бізнесу та життя');
        OpenGraph::setDescription('Постачання серверів, робочих станцій, промислових ПК та ДБЖ у Дніпрі.');

        $featuredProducts = Product::active()
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('home.index', [
            'featuredProducts' => $featuredProducts,
        ]);
    }

    public function about(): View
    {
        SEOMeta::setTitle('Про компанію | ТОВ фірма "ВІСТ"');
        SEOMeta::setDescription('ТОВ фірма "ВІСТ" — понад 25 років досвіду на ринку ІТ-обладнання. Офіційний постачальник серверів, робочих станцій та промислових рішень у Дніпрі.');

        return view('about.index');
    }
}
