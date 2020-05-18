<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraOption extends Model
{
    protected $fillable = [
        'product_id', 'order_id', 'price', 'description_nl', 'description_en',
    ];

    public function sale() {
        return Sale::query()
            ->where('product_id', $this->product_id)
            ->where('order_id', $this->order_id);
    }
}
