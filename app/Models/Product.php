<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'type',
        'name',
        'slug',
        'short_desc',
        'description',
        'price',
        'currency',
        'status',
        'is_active',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationship до галереї зображень
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    // Головне зображення
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', 1);
    }

    // Характеристики
    public function specs()
    {
        return $this->hasMany(ProductSpec::class)->orderBy('sort_order');
    }

    // Активні продукти
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    // Форматована ціна
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' ' . $this->currency;
    }

    // URL зображення
    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset($this->image) : asset('img/placeholder.jpg');
    }
}
