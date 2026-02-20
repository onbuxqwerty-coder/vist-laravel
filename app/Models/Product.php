<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category',
        'title',
        'subtitle',
        'slug',
        'sku',
        'image',
        'description',
        'price',
        'currency',
        'status',
        'is_active',
    ];

    protected static function booted(): void
    {
        static::created(function (Product $product) {
            $product->updateQuietly(['sku' => '0000' . $product->id]);
        });
    }

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

        // URL головного зображення (product_images)
    public function getMainImageUrlAttribute(): string
    {
        $img = $this->relationLoaded('primaryImage')
            ? $this->primaryImage
            : $this->primaryImage()->first();

        if (!$img) {
            $img = $this->relationLoaded('images')
                ? $this->images->sortByDesc('is_primary')->first()
                : $this->images()->orderByDesc('is_primary')->first();
        }

        return $img ? asset($img->image) : asset('img/placeholder.jpg');
    }

}
