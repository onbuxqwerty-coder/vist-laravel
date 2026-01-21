<?php

namespace App\Helpers;

use App\Models\ProductPrice;
use Carbon\Carbon;

/**
 * Helper для роботи з гнучкою системою цін
 */
class PriceHelper
{
    /**
     * Отримати актуальну ціну для продукту
     * 
     * @param int $productId
     * @return array ['price' => float, 'type' => string, 'old_price' => float|null]
     */
    public static function getActivePrice(int $productId): array
    {
        $now = Carbon::now();
        
        // Шукаємо активну акційну ціну
        $promoPrice = ProductPrice::where('product_id', $productId)
            ->where('price_type', 'promo')
            ->where('is_active', 1)
            ->where(function($query) use ($now) {
                $query->whereNull('valid_from')
                    ->orWhere('valid_from', '<=', $now);
            })
            ->where(function($query) use ($now) {
                $query->whereNull('valid_to')
                    ->orWhere('valid_to', '>=', $now);
            })
            ->orderBy('created_at', 'desc')
            ->first();
        
        if ($promoPrice) {
            // Є акція — шукаємо стару ціну
            $oldPrice = ProductPrice::where('product_id', $productId)
                ->where('price_type', 'old')
                ->where('is_active', 1)
                ->where(function($query) use ($now) {
                    $query->whereNull('valid_from')
                        ->orWhere('valid_from', '<=', $now);
                })
                ->where(function($query) use ($now) {
                    $query->whereNull('valid_to')
                        ->orWhere('valid_to', '>=', $now);
                })
                ->orderBy('created_at', 'desc')
                ->first();
            
            return [
                'price' => $promoPrice->price,
                'type' => 'promo',
                'old_price' => $oldPrice ? $oldPrice->price : null,
                'currency' => $promoPrice->currency,
            ];
        }
        
        // Немає акції — шукаємо "від" або базову
        $fromPrice = ProductPrice::where('product_id', $productId)
            ->where('price_type', 'from')
            ->where('is_active', 1)
            ->first();
        
        if ($fromPrice) {
            return [
                'price' => $fromPrice->price,
                'type' => 'from',
                'old_price' => null,
                'currency' => $fromPrice->currency,
            ];
        }
        
        // Базова ціна
        $basePrice = ProductPrice::where('product_id', $productId)
            ->where('price_type', 'base')
            ->where('is_active', 1)
            ->first();
        
        if ($basePrice) {
            return [
                'price' => $basePrice->price,
                'type' => 'base',
                'old_price' => null,
                'currency' => $basePrice->currency,
            ];
        }
        
        // Якщо нічого не знайдено
        return [
            'price' => 0,
            'type' => 'none',
            'old_price' => null,
            'currency' => 'UAH',
        ];
    }
    
    /**
     * Форматувати ціну для відображення
     * 
     * @param array $priceData Результат від getActivePrice()
     * @return string
     */
    public static function formatPrice(array $priceData): string
    {
        $price = number_format($priceData['price'], 0, ',', ' ');
        $currency = $priceData['currency'] === 'UAH' ? '₴' : $priceData['currency'];
        
        switch ($priceData['type']) {
            case 'from':
                return "від {$price} {$currency}";
            
            case 'promo':
                $result = "<span class='promo-price'>{$price} {$currency}</span>";
                if ($priceData['old_price']) {
                    $oldPrice = number_format($priceData['old_price'], 0, ',', ' ');
                    $result .= " <span class='old-price'>{$oldPrice} {$currency}</span>";
                }
                return $result;
            
            case 'base':
                return "{$price} {$currency}";
            
            default:
                return "Ціна за запитом";
        }
    }
    
    /**
     * Отримати всі ціни для продукту (для адмін-панелі)
     * 
     * @param int $productId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllPrices(int $productId)
    {
        return ProductPrice::where('product_id', $productId)
            ->orderByRaw("FIELD(price_type, 'from', 'base', 'promo', 'old')")
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    /**
     * Перевірити чи активна акція
     * 
     * @param int $productId
     * @return bool
     */
    public static function hasActivePromo(int $productId): bool
    {
        $priceData = self::getActivePrice($productId);
        return $priceData['type'] === 'promo';
    }
}
