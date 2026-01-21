<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRelated extends Model
{
    public $timestamps = false;

    protected $table = 'product_related';

    protected $fillable = [
        'product_id',
        'related_id',
        'relation_type',
    ];

    protected $casts = [
        'product_id' => 'integer',
        'related_id' => 'integer',
    ];

    /**
     * Типи зв'язків
     */
    public const TYPE_RECOMMENDED = 'recommended';
    public const TYPE_ACCESSORY = 'accessory';
    public const TYPE_ALTERNATIVE = 'alternative';

    /**
     * Отримати мітку типу зв'язку
     */
    public function getRelationTypeLabelAttribute(): string
    {
        return match($this->relation_type) {
            self::TYPE_RECOMMENDED => 'Рекомендований',
            self::TYPE_ACCESSORY => 'Аксесуар',
            self::TYPE_ALTERNATIVE => 'Альтернатива',
            default => 'Пов\'язаний',
        };
    }
}
