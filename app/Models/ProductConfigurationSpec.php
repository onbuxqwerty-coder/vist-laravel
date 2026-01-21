<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductConfigurationSpec extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'configuration_id',
        'spec_key',
        'spec_value',
        'sort_order',
    ];

    protected $casts = [
        'configuration_id' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Конфігурація, до якої належить специфікація
     */
    public function configuration(): BelongsTo
    {
        return $this->belongsTo(ProductConfiguration::class, 'configuration_id');
    }
}
