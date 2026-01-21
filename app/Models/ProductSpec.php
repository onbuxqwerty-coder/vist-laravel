<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSpec extends Model
{
    /**
     * Назва таблиці
     */
    protected $table = 'product_specs';

    /**
     * Вимкнути автоматичні timestamps
     */
    public $timestamps = false;

    /**
     * Поля для масового заповнення
     */
    protected $fillable = [
        'product_id',
        'spec_key',
        'spec_value',
        'sort_order',
    ];

    /**
     * Приведення типів
     */
    protected $casts = [
        'product_id' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Відношення до продукту
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Отримати іконку для типу характеристики
     */
    public function getIconAttribute(): string
    {
        return match($this->spec_key) {
            'CPU', 'CPU_Type' => '🔧',
            'RAM', 'RAM_Type' => '💾',
            'GPU', 'GPU_VRAM' => '🎮',
            'Storage', 'Storage_Type' => '💿',
            'PSU' => '⚡',
            'OS' => '🖥️',
            'Controller', 'Controller_Type' => '🎛️',
            'Management', 'Management_Type' => '🔐',
            'Device_Class' => '📦',
            'Form_Factor' => '📐',
            default => '⚙️',
        };
    }

    /**
     * Отримати українську назву ключа
     */
    public function getLabelAttribute(): string
    {
        return match($this->spec_key) {
            'CPU' => 'Процесор',
            'CPU_Type' => 'Тип процесора',
            'RAM' => 'Оперативна пам\'ять',
            'RAM_Type' => 'Тип пам\'яті',
            'GPU' => 'Відеокарта',
            'GPU_VRAM' => 'Відеопам\'ять',
            'Storage' => 'Накопичувач',
            'Storage_Type' => 'Тип накопичувача',
            'PSU' => 'Блок живлення',
            'OS' => 'Операційна система',
            'Controller' => 'Контролер',
            'Controller_Type' => 'Тип контролера',
            'Management' => 'Керування',
            'Management_Type' => 'Тип керування',
            'Device_Class' => 'Клас пристрою',
            'Form_Factor' => 'Форм-фактор',
            default => $this->spec_key,
        };
    }
}