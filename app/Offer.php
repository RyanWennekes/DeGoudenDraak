<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'product_id', 'discount', 'date_start', 'date_end',
    ];
}
