<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\SaleTransaction;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleTransactionController;
use App\Http\Controllers\StockTransactionController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {

        // Data Produk & Kategori
        $produks = Produk::with('kategori')
            ->latest()
            ->get();

        $kategoris = Kategori::with('produks')
            ->latest()
            ->get();

        $penjualanKategori = Kategori::leftJoin('produks', 'kategoris.id', '=', 'produks.kategori_id')
            ->leftJoin('sale_transactions', 'produks.id', '=', 'sale_transactions.produk_id')
            ->select(
                'kategoris.nama_kategori',
                DB::raw('COALESCE(SUM(sale_transactions.qty),0) as total_penjualan')
            )
            ->groupBy('kategoris.id', 'kategoris.nama_kategori')
            ->get();

        // Data Penjualan
        $totalTransaksi = SaleTransaction::count();

        $totalPendapatan = SaleTransaction::sum('total');

        $transaksiTerbaru = SaleTransaction::with('produk')
            ->latest()
            ->take(5)
            ->get();

        // System Insight
        $produkStokTerendah = Produk::orderBy('stok')->first();

        $produkTerlaris = Produk::withCount('saleTransactions')
            ->orderByDesc('sale_transactions_count')
            ->first();

        return view('dashboard', compact(
            'produks',
            'kategoris',
            'penjualanKategori',
            'totalTransaksi',
            'totalPendapatan',
            'transaksiTerbaru',
            'produkStokTerendah',
            'produkTerlaris'
        ));
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | RESOURCE ROUTES
    |--------------------------------------------------------------------------
    */

    Route::resource('kategori', KategoriController::class)
        ->except(['show']);

    Route::resource('produk', ProdukController::class);

    Route::resource('sale-transactions', SaleTransactionController::class);

    Route::resource('stock-transactions', StockTransactionController::class);

    /*
    |--------------------------------------------------------------------------
    | REPORT PENJUALAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/sale-transactions/export/excel',
        [SaleTransactionController::class, 'exportExcel']
    )->name('sale-transactions.export.excel');

    Route::get(
        '/sale-transactions/export/pdf',
        [SaleTransactionController::class, 'exportPdf']
    )->name('sale-transactions.export.pdf');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';