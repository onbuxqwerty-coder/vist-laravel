<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductConfiguration extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'config_name',
        'price',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'product_id' => 'integer',
    ];

    /**
     * Продукт, до якого належить конфігурація
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Специфікації конфігурації
     */
    public function specs(): HasMany
    {
        return $this->hasMany(ProductConfigurationSpec::class, 'configuration_id')
            ->orderBy('sort_order');
    }

    /**
     * Отримати текст ціни
     */
    public function getPriceTextAttribute(): string
    {
        if ($this->price === null || $this->price == 0) {
            return 'індивідуально';
        }
        return number_format($this->price, 0, ',', ' ') . ' ₴';
    }

    /**
     * Отримати специфікації як асоціативний масив
     */
    public function getSpecsArrayAttribute(): array
    {
        return $this->specs()
            ->pluck('spec_value', 'spec_key')
            ->toArray();
    }
}
