<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    protected $fillable = [
        'product_id', 'discount', 'date_start', 'date_end',
    ];

    function offer(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
