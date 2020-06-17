<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Order extends Model
{
    protected $fillable = [
        'table_id', 'needs_help',
    ];

    public static function orders(Carbon $date): Collection
    {
        return Order::query()
            ->whereDate('created_at', '=', $date)
            ->with('sales.product')
            ->groupBy('orders.id')
            ->orderBy('orders.created_at', 'desc')
            ->get();
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function sales(): HasMany
    {
        return $this->HasMany(Sale::class);
    }
}
