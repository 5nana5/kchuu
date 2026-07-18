<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class SaleTransaction extends Model
{
    protected $fillable = [
        'transaction_number',
        'transaction_date',
        'produk_id',
        'qty',
        'harga',
        'total',
        'merchant_code',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
