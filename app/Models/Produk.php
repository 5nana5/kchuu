<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\SaleTransaction;
use App\Models\StockTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'harga',
        'stok',
        'deskripsi',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

        // Relasi ke transaksi penjualan
    public function saleTransactions()
    {
        return $this->hasMany(SaleTransaction::class);
    }

    // Relasi ke barang masuk
    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }
}
