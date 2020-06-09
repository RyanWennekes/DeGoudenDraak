<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Offer extends Model
{
    protected $fillable = [
        'product_id', 'discount', 'date_start', 'date_end',
    ];

    public static function offers(): Collection
    {
        return Offer::all();
    }

    function offer(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
