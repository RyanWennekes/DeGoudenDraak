<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'product_type_id', 'name', 'price', 'spiciness', 'description_nl', 'description_en', 'minimum_amount',
    ];

    function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    function allergenes()
    {
        return $this->hasMany(ProductAllergene::class)->with('allergene');
    }

    function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}
