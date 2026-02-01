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
<link rel="stylesheet" href="{{ asset('css/product-price.css') }}">
@endpush
