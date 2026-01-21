<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSeo extends Model
{
    public $timestamps = false;

    protected $table = 'product_seo';

    protected $fillable = [
        'product_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'slug',
    ];

    protected $casts = [
        'product_id' => 'integer',
    ];

    /**
     * Продукт, до якого належать SEO дані
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Отримати повний URL продукту
     */
    public function getFullUrlAttribute(): string
    {
        return url('/product/' . $this->slug);
    }
}
