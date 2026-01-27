<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Словник категорій з емодзі та зрозумілими назвами
     */
    protected $typeLabels = [
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
        $allowedColumns = ['id', 'name', 'type', 'price', 'is_active', 'created_at'];

        if (!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'created_at';
        }

        $products = Product::orderBy($sortColumn, $sortOrder)->paginate(20);

        return view('admin.products.index', [
            'products'   => $products,
            'sortColumn' => $sortColumn,
            'sortOrder'  => $sortOrder,
            'typeLabels' => $this->typeLabels
        ]);
    }

    /**
     * Форма створення нового товару
     */
    public function create()
    {
        return view('admin.products.create', [
            'typeLabels' => $this->typeLabels
        ]);
    }

    /**
     * Збереження товару в базу
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:' . implode(',', array_keys($this->typeLabels)),
            'price'       => 'required|numeric|min:0',
            'is_active'   => 'boolean',
            'slug'        => 'nullable|string|max:255',
            'short_desc'  => 'nullable|string',
            'description' => 'nullable|string',
            'currency'    => 'nullable|string|max:10',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Автогенерація slug якщо не вказано
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        }

        // Встановлюємо значення за замовчуванням
        $validated['currency'] = $validated['currency'] ?? 'UAH';
        $validated['status'] = 'in_stock';
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        // Створюємо продукт
        $product = Product::create($validated);

        // Зберігаємо характеристики
        if ($request->has('specs')) {
            foreach ($request->specs as $index => $specData) {
                if (!empty($specData['value'])) {
                    // Визначаємо назву характеристики
                    $specName = $specData['name'] === 'custom' 
                        ? ($specData['name_custom'] ?? '') 
                        : $specData['name'];
                    
                    if (!empty($specName)) {
                        $product->specs()->create([
                            'spec_key'   => $specName,
                            'spec_value' => $specData['value'],
                            'sort_order' => $index,
                        ]);
                    }
                }
            }
        }

        // Зберігаємо зображення
        if ($request->hasFile('images')) {
            $sortOrder = 1;
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $sortOrder . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/products'), $filename);
                
                $product->images()->create([
                    'image' => 'img/products/' . $filename,
                    'is_primary' => $sortOrder === 1 ? 1 : 0,
                    'sort_order' => $sortOrder,
                ]);
                
                $sortOrder++;
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успішно додано до каталогу!');
    }

    /**
     * Форма редагування існуючого товару
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product'    => $product,
            'typeLabels' => $this->typeLabels
        ]);
    }

    /**
     * Оновлення даних товару
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:' . implode(',', array_keys($this->typeLabels)),
            'price'       => 'required|numeric|min:0',
            'is_active'   => 'boolean',
            'slug'        => 'nullable|string|max:255',
            'short_desc'  => 'nullable|string',
            'description' => 'nullable|string',
            'currency'    => 'nullable|string|max:10',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Автогенерація slug якщо не вказано
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        }

        // Встановлюємо значення
        $validated['currency'] = $validated['currency'] ?? 'UAH';
        $validated['status'] = 'in_stock';
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        // Оновлюємо продукт
        $product->update($validated);

        // Оновлюємо характеристики (видаляємо старі і додаємо нові)
        $product->specs()->delete();
        
        if ($request->has('specs')) {
            foreach ($request->specs as $index => $specData) {
                if (!empty($specData['value'])) {
                    // Визначаємо назву характеристики
                    $specName = $specData['name'] === 'custom' 
                        ? ($specData['name_custom'] ?? '') 
                        : $specData['name'];
                    
                    if (!empty($specName)) {
                        $product->specs()->create([
                            'spec_key'   => $specName,
                            'spec_value' => $specData['value'],
                            'sort_order' => $index,
                        ]);
                    }
                }
            }
        }

        // Видаляємо обрані зображення
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $product->images()->find($imageId);
                if ($image) {
                    // Видаляємо файл
                    $imagePath = public_path($image->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    // Видаляємо запис з БД
                    $image->delete();
                }
            }
        }

        // Додаємо нові зображення
        if ($request->hasFile('images')) {
            $currentMaxOrder = $product->images()->max('sort_order') ?? 0;
            $sortOrder = $currentMaxOrder + 1;
            
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $sortOrder . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/products'), $filename);
                
                $product->images()->create([
                    'image' => 'img/products/' . $filename,
                    'is_primary' => $product->images()->count() === 0 ? 1 : 0,
                    'sort_order' => $sortOrder,
                ]);
                
                $sortOrder++;
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Дані товару успішно оновлено!');
    }

    /**
     * Видалення товару
     */
    public function destroy(Product $product)
    {
        // Видаляємо всі зображення продукту
        foreach ($product->images as $image) {
            $imagePath = public_path($image->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Видаляємо продукт (каскадно видаляться specs і images через onDelete в міграції)
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар видалено з системи.');
    }
}