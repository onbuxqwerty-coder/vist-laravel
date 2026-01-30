<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appeal extends Model
{
    protected $fillable = [
        'date',
        'time',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'product_name',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
