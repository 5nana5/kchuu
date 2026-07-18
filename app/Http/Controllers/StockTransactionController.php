<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockTransaction;
use App\Models\Produk;

class StockTransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $transactions = StockTransaction::with('produk')
            ->latest()
            ->get();


        $produks = Produk::latest()
            ->get();


        return view(
            'stock-transactions.index',
            compact(
                'transactions',
                'produks'
            )
        );

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $produks = Produk::latest()
            ->get();


        return view(
            'stock-transactions.create',
            compact('produks')
        );

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'produk_id' =>
                'required|exists:produks,id',

            'qty' =>
                'required|integer|min:1',

        ]);



        $produk = Produk::findOrFail(
            $request->produk_id
        );



        // Tambah stok produk

        $produk->increment(
            'stok',
            $request->qty
        );



        StockTransaction::create([

            'stock_code' =>
                'STK-' .
                str_pad(
                    StockTransaction::count() + 1,
                    6,
                    '0',
                    STR_PAD_LEFT
                ),


            'transaction_date' =>
                now(),


            'produk_id' =>
                $produk->id,


            'qty' =>
                $request->qty,

        ]);



        return redirect()
            ->route('stock-transactions.index')
            ->with(
                'success',
                'Stok berhasil ditambahkan.'
            );

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
     * Update the specified resource.
     */
    public function update(Request $request, string $id)
    {
        //
    }



    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        //
    }

}