<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Produk;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kategori'];
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
