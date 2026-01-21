<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductPrice extends Model
{
    protected $table = 'product_prices';
    
    protected $fillable = [
        'product_id',
        'price',
        'currency',
        'price_type',
        'valid_from',
        'valid_to',
        'is_active',
    ];
    
    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];
    
    /**
     * Зв'язок з продуктом
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    /**
     * Scope: Тільки активні ціни
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    
    /**
     * Scope: Тільки валідні за датами ціни
     */
    public function scopeValid($query, Carbon $date = null)
    {
        $date = $date ?? Carbon::now();
        
        return $query->where(function($q) use ($date) {
            $q->whereNull('valid_from')
              ->orWhere('valid_from', '<=', $date);
        })->where(function($q) use ($date) {
            $q->whereNull('valid_to')
              ->orWhere('valid_to', '>=', $date);
        });
    }
    
    /**
     * Scope: Ціни певного типу
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('price_type', $type);
    }
    
    /**
     * Перевірити чи ціна зараз валідна
     */
    public function isCurrentlyValid(): bool
    {
        $now = Carbon::now();
        
        if ($this->valid_from && $this->valid_from->isAfter($now)) {
            return false;
        }
        
        if ($this->valid_to && $this->valid_to->isBefore($now)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Отримати форматовану ціну
     */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' ₴';
    }
    
    /**
     * Отримати назву типу українською
     */
    public function getTypeNameAttribute(): string
    {
        return match($this->price_type) {
            'from' => 'Від',
            'base' => 'Базова',
            'promo' => 'Акційна',
            'old' => 'Стара',
            default => 'Невідомий тип',
        };
    }
}
