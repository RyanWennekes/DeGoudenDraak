<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAllergene extends Model
{
    protected $fillable = [
        'product_id', 'allergene_id',
    ];

    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    function allergene(): BelongsTo
    {
        return $this->belongsTo(Allergene::class);
    }
}
