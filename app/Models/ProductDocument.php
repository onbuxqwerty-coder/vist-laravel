<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDocument extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'doc_title',
        'doc_url',
        'doc_type',
        'sort_order',
    ];

    protected $casts = [
        'product_id' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Типи документів
     */
    public const TYPE_PDF = 'pdf';
    public const TYPE_MANUAL = 'manual';
    public const TYPE_CERTIFICATE = 'certificate';
    public const TYPE_OTHER = 'other';

    /**
     * Продукт, до якого належить документ
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Отримати мітку типу документа
     */
    public function getTypeLabelAttribute(): string
    {
        return match($this->doc_type) {
            self::TYPE_PDF => 'PDF',
            self::TYPE_MANUAL => 'Інструкція',
            self::TYPE_CERTIFICATE => 'Сертифікат',
            self::TYPE_OTHER => 'Інше',
            default => 'Документ',
        };
    }

    /**
     * Scope для фільтрації по типу
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('doc_type', $type);
    }
}
