{{-- resources/views/components/product-price.blade.php --}}

@props(['product'])

@php
    $priceData = $product->getActivePrice();
@endphp

<div class="vist-product-price">
    @if($priceData['type'] === 'promo')
        {{-- Акційна ціна + стара ціна --}}
        <div class="price-container price-promo">
            <span class="promo-badge">АКЦІЯ</span>
            <div class="price-row">
                <span class="current-price">
                    {{ number_format($priceData['price'], 0, ',', ' ') }} ₴
                </span>
                @if($priceData['old_price'])
                    <span class="old-price">
                        {{ number_format($priceData['old_price'], 0, ',', ' ') }} ₴
                    </span>
                @endif
            </div>
            @if($priceData['old_price'])
                @php
                    $discount = round((($priceData['old_price'] - $priceData['price']) / $priceData['old_price']) * 100);
                @endphp
                <span class="discount-badge">-{{ $discount }}%</span>
            @endif
        </div>
        
    @elseif($priceData['type'] === 'from')
        {{-- Ціна "від" --}}
        <div class="price-container price-from">
            <span class="price-prefix">від</span>
            <span class="current-price">
                {{ number_format($priceData['price'], 0, ',', ' ') }} ₴
            </span>
        </div>
        
    @elseif($priceData['type'] === 'base')
        {{-- Базова ціна --}}
        <div class="price-container price-base">
            <span class="current-price">
                {{ number_format($priceData['price'], 0, ',', ' ') }} ₴
            </span>
        </div>
        
    @else
        {{-- Ціна за запитом --}}
        <div class="price-container price-request">
            <span class="price-text">Ціна за запитом</span>
        </div>
    @endif
</div>

@push('styles')
<style>
.vist-product-price {
    margin: 1rem 0;
}

.price-container {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.price-promo {
    position: relative;
}

.promo-badge {
    display: inline-block;
    background: #e74c3c;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
}

.price-row {
    display: flex;
    align-items: baseline;
    gap: 1rem;
}

.current-price {
    font-size: 1.75rem;
    font-weight: bold;
    color: #2c3e50;
}

.price-promo .current-price {
    color: #e74c3c;
}

.old-price {
    font-size: 1.25rem;
    color: #95a5a6;
    text-decoration: line-through;
}

.discount-badge {
    display: inline-block;
    background: #27ae60;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.875rem;
    font-weight: bold;
}

.price-from .price-prefix {
    font-size: 1rem;
    color: #7f8c8d;
    margin-right: 0.25rem;
}

.price-request .price-text {
    font-size: 1.25rem;
    color: #7f8c8d;
    font-style: italic;
}
</style>
@endpush
