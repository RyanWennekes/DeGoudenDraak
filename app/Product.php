<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Collection\Collection;

class Product extends Model
{
    protected $fillable = [
        'product_type_id', 'name', 'price', 'spiciness', 'description_nl', 'description_en', 'minimum_amount',
    ];

    public static function productWithSales(): \Illuminate\Support\Collection
    {
        return Product::all();
    }

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
