<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{
    protected $fillable = [
        'type_nl', 'type_en',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
