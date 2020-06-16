<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $with = ['offers'];
    use SoftDeletes;

    public $timestamps = false;

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'product_type_id', 'name', 'price', 'spiciness', 'description_nl', 'description_en', 'minimum_amount', 'code',
    ];

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function products(): Collection
    {
        return Product::query()->select('id', 'name')->get();
    }

    public static function productWithSales(): \Illuminate\Support\Collection
    {
        return Product::query()
            ->leftJoin('offers', function ($join) {
                $join->on('products.id', '=', 'offers.product_id')
                    ->where('offers.date_start', '<=', NOW())
                    ->where('offers.date_end', '>=', NOW());
            })
            ->whereNull('deleted_at')
            ->select('products.*',
                DB::raw('(case when offers.discount then products.price * ((100 - offers.discount) / 100) else products.price end) as discountPrice'))
            ->get();
    }

    function offers(): HasMany
    {
        return $this->hasMany(Offer::class)
            ->where('date_start', '<=', NOW())
            ->where('date_end', '>=', NOW());
    }

    function allergenes()
    {
        return $this->hasMany(ProductAllergene::class)->with('allergene');
    }

    function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}
