<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_type_id', 'name', 'price', 'spiciness', 'description_nl', 'description_en', 'minimum_amount'
    ];
}
