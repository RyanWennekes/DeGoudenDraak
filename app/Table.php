<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Collection\Collection;

class Table extends Model
{
    protected $fillable = [
        'menu_id', 'table_number', 'waitress_id',
    ];

    public static function allTables()
    {
        return Table::all();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function waitress(): BelongsTo
    {
        return $this->belongsTo(User::class, 'waitress_id');
    }
}
