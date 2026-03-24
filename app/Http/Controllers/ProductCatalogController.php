<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

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

        $seo = [
            'workstation' => [
                'title'       => 'Робочі станції | ТОВ фірма "ВІСТ"',
                'description' => 'Професійні робочі станції для CAD, 3D-рендерингу та відеомонтажу. Постачання та налаштування у Дніпрі. Гарантія.',
                'keywords'    => ['робочі станції', 'workstation', 'CAD комп\'ютер', 'сервер Дніпро', 'VIST'],
            ],
            'server' => [
                'title'       => 'Серверне обладнання | ТОВ фірма "ВІСТ"',
                'description' => 'Tower, Rack та Blade-сервери, NAS/SAN сховища. Збирання під замовлення. Постачання серверного обладнання у Дніпрі.',
                'keywords'    => ['сервери', 'rack сервер', 'tower сервер', 'NAS SAN', 'серверне обладнання Дніпро'],
            ],
            'ipc' => [
                'title'       => 'Промислові ПК | ТОВ фірма "ВІСТ"',
                'description' => 'Panel PC, Box PC, Rackmount-системи та захищені планшети для промислової автоматизації. Широкий температурний діапазон, IP65/IP67.',
                'keywords'    => ['промислові ПК', 'Panel PC', 'Box PC', 'промислова автоматизація', 'IPC Дніпро'],
            ],
            'ups' => [
                'title'       => 'ДБЖ (UPS) | ТОВ фірма "ВІСТ"',
                'description' => 'Джерела безперебійного живлення APC та Eaton: Line-Interactive, On-line, трифазні системи. Офіційні поставки та сервіс у Дніпрі.',
                'keywords'    => ['ДБЖ', 'UPS', 'APC Smart-UPS', 'Eaton 9SX', 'безперебійне живлення Дніпро'],
            ],
        ];

        SEOMeta::setTitle($seo[$type]['title']);
        SEOMeta::setDescription($seo[$type]['description']);
        SEOMeta::setKeywords($seo[$type]['keywords']);
        OpenGraph::setTitle($seo[$type]['title']);
        OpenGraph::setDescription($seo[$type]['description']);

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
