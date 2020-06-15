<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{
    protected $fillable = [
        'type_nl', 'type_en',
    ];

    protected $with = [
        'products'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
