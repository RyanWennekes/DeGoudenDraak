<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'product_id', 'order_id', 'price', 'amount', 'created_at', 'updated_at',
    ];
}
