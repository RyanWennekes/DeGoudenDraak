<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraOption extends Model
{
    protected $fillable = [
        'product_id', 'order_id', 'price', 'description_nl', 'description_en',
    ];
}
