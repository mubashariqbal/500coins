<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = [
        'price_date' => 'date',
        'price_timestamp' => 'datetime',

        'first_candle' => 'datetime',
        'first_trade' => 'datetime',
        'first_order_book' => 'datetime',
        'first_priced_at' => 'datetime',

        'high_timestamp' => 'datetime',
    ];
}
