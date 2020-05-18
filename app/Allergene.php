<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Allergene extends Model
{

    protected $fillable = [
        'name_nl', 'name_en',
    ];

    public function products()
    {
        return $this->hasMany(ProductAllergene::class)->with('product');
    }
}
