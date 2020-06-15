<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'product_id', 'order_id', 'price', 'amount', 'created_at', 'updated_at', 'comment',
    ];

    public static function selectedSales(Carbon $start_date, Carbon $end_date): Collection
    {
        return Sale::query()
            ->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->get();
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function extraOptions()
    {
        return ExtraOption::query()
            ->where('product_id', $this->product_id)
            ->where('order_id', $this->order_id);
    }
}
