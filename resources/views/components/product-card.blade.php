{{-- resources/views/components/product-card.blade.php --}}

{{-- 
    Універсальна картка продукту VIST
    
    Props:
    - $product (object) - об'єкт Product model
    
    Використання:
    <x-product-card :product="$product" />
--}}

@props(['product'])

@php
    // Визначення типу продукту та відповідного route
    $categoryRoutes = [
        'workstation' => 'workstations',
        'server' => 'servers',
        'ipc' => 'industrial',
        'storage' => 'ups',
    ];
    
    $routeName = $categoryRoutes[$product->category] ?? 'products';
    
    // Отримання головного зображення
    $mainImage = $product->images->where('is_primary', 1)->first() 
        ?? $product->images->first() 
        ?? null;
    
    $imageUrl = $mainImage ? asset($mainImage->image_url) : asset('img/placeholder-product.jpg');
    
    // Мапа типів для відображення
    $typeLabels = [
        'workstation' => 'Робоча станція',
        'server' => 'Сервер',
        'ipc' => 'Промисловий ПК',
        'storage' => 'ДБЖ',
    ];
    
    $typeLabel = $typeLabels[$product->category] ?? 'Обладнання';
    
    // Мапа статусів
    $statusLabels = [
        'in_stock' => 'Є на складі',
        'by_order' => 'Під замовлення',
        'out_of_stock' => 'Немає в наявності',
    ];
    
    $statusClasses = [
        'in_stock' => 'ok',
        'by_order' => 'warn',
        'out_of_stock' => 'danger',
    ];
    
    $statusLabel = $statusLabels[$product->status] ?? '';
    $statusClass = $statusClasses[$product->status] ?? '';
    
    // Ціна
    if ($product->price === null || $product->price === '') {
        $priceText = 'індивідуально';
    } else {
        $priceText = 'від ' . number_format((float)$product->price, 0, ',', ' ') . ' ₴';
    }
    
    // Короткі характеристики (перші 3)
    $specs = $product->specs->take(3);
@endphp

<article class="vist-product-card vist-product-card--{{ $product->category }}">
    <div class="vist-card-image">
        <img src="{{ $imageUrl }}" alt="{{ $product->title }}" loading="lazy">
    </div>

    <div class="vist-card-type">
        {{ $typeLabel }}
    </div>

    <h3 class="vist-card-title">
        {{ $product->title }}
    </h3>

    @if($product->subtitle)
        <p class="vist-card-subtitle">
            {{ $product->subtitle }}
        </p>
    @endif

    @if($specs->isNotEmpty())
        <ul class="vist-card-specs">
            @foreach($specs as $spec)
                <li>{{ $spec->spec_value }}</li>
            @endforeach
        </ul>
    @endif

    <div class="vist-card-meta">
        @if($statusLabel)
            <span class="vist-status {{ $statusClass }}">
                {{ $statusLabel }}
            </span>
        @endif

        <span class="vist-price">
            {{ $priceText }}
        </span>
    </div>

    <a href="{{ route($routeName . '.show', $product->id) }}" class="vist-btn-card">
        Детальніше
    </a>
</article>