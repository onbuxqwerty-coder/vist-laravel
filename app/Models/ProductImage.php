<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    /**
     * Назва таблиці
     */
    protected $table = 'product_images';

    /**
     * Вимкнути автоматичні timestamps
     */
    public $timestamps = false;

    /**
     * Поля для масового заповнення
     */
    protected $fillable = [
        'product_id',
        'image',
        'sort_order',
        'alt_text',
        'is_primary',
    ];

    /**
     * Приведення типів
     */
    protected $casts = [
        'product_id' => 'integer',
        'sort_order' => 'integer',
        'is_primary' => 'boolean',
    ];

    /**
     * Відношення до продукту
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Отримати повний URL зображення
     */
    public function getUrlAttribute(): string
    {
        return asset($this->image);
    }

    /**
     * Отримати alt текст (або назву продукту)
     */
    public function getAltAttribute(): string
    {
        return $this->alt_text ?? $this->product->title ?? '';
    }
}