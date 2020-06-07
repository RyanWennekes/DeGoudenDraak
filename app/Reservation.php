<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $fillable = [
        'menu_id', 'table_number', 'check_in_time', 'waitress_id',
    ];
}
