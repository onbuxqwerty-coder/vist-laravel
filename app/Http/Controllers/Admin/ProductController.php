<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Виправляє помилку "Class Controller not found"
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Словник категорій з емодзі та зрозумілими назвами
     */
    protected $categoryLabels = [
        'workstation' => '💻 Робочі станції',
        'server'      => '🖥️ Сервери',
        'industrial'  => '🏭 Промислові ПК',
        'ups'         => '🔋 ДБЖ (UPS)',
        'other'       => '📦 Інше'
    ];

    /**
     * Відображення списку товарів
     */
    public function index(Request $request)
    {
        $sortColumn = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        $allowedColumns = ['id', 'title', 'category', 'price', 'is_active', 'created_at'];
        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'created_at';
        }

        $products = Product::orderBy($sortColumn, $sortOrder)->paginate(20);

        // Передаємо дані у в'юшку admin.products.index
        return view('admin.products.index', [
            'products'       => $products,
            'sortColumn'     => $sortColumn,
            'sortOrder'      => $sortOrder,
            'categoryLabels' => $this->categoryLabels
        ]);
    }

    /**
     * Форма створення нового товару
     */
    public function create()
    {
        return view('admin.products.create', [
            'categoryLabels' => $this->categoryLabels
        ]);
    }

    /**
     * Збереження товару в базу
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|in:' . implode(',', array_keys($this->categoryLabels)),
            'price'     => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успішно додано до каталогу!');
    }

    /**
     * Форма редагування існуючого товару
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product'        => $product,
            'categoryLabels' => $this->categoryLabels
        ]);
    }

    /**
     * Оновлення даних товару
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|in:' . implode(',', array_keys($this->categoryLabels)),
            'price'     => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Дані товару успішно оновлено!');
    }

    /**
     * Видалення товару
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар видалено з системи.');
    }
}