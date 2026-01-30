<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['appeal_id', 'body'];

    public function appeal(): BelongsTo
    {
        return $this->belongsTo(Appeal::class);
    }
}
