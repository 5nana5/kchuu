<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;


class StockTransaction extends Model
{
    protected $fillable = [
        'stock_code',
        'transaction_date',
        'produk_id',
        'qty',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
