<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleTransaction;
use App\Models\Produk;

use App\Exports\SaleTransactionExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = SaleTransaction::with('produk')
            ->latest()
            ->get();

        return view('sale-transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::all();

        return view('sale-transactions.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id'     => 'required|exists:produks,id',
            'qty'           => 'required|integer|min:1',
            'merchant_code' => 'required',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        if ($produk->stok < $request->qty) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Kurangi stok
        $produk->decrement('stok', $request->qty);

        // Simpan transaksi
        SaleTransaction::create([
            'transaction_number' => 'TRX-' . str_pad(SaleTransaction::count() + 1, 6, '0', STR_PAD_LEFT),
            'transaction_date'   => now(),
            'produk_id'          => $produk->id,
            'qty'                => $request->qty,
            'harga'              => $produk->harga,
            'total'              => $produk->harga * $request->qty,
            'merchant_code'      => $request->merchant_code,
        ]);

        return redirect()
            ->route('sale-transactions.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    /**
     * Export Excel
     */
    public function exportExcel()
    {
        return Excel::download(
            new SaleTransactionExport,
            'transaksi_penjualan.xlsx'
        );
    }

    /**
     * Export PDF
     */
    public function exportPdf()
    {
        $transactions = SaleTransaction::with('produk')
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'sale-transactions.pdf',
            compact('transactions')
        );

        return $pdf->download('transaksi_penjualan.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}