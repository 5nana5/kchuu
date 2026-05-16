<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN SEMUA PRODUK
    |--------------------------------------------------------------------------
    */
    
    public function index(Request $request)
    {

        $query = Produk::with('kategori');

        // FILTER KATEGORI
        if ($request->kategori) {

            $query->where(
                'kategori_id',
                $request->kategori
            );

        }

        $produks = $query
            ->latest()
            ->get();

        $kategoris = Kategori::latest()
            ->get();

        return view(
            'produk.index',
            compact(
                'produks',
                'kategoris'
            )
        );

    }



    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {

        return redirect()
            ->route('produk.index');

    }



    /*
    |--------------------------------------------------------------------------
    | SIMPAN PRODUK
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'kategori_id' =>
                'required|exists:kategoris,id',

            'nama_produk' =>
                'required|string|max:255',

            'harga' =>
                'required|numeric|min:0',

            'stok' =>
                'required|integer|min:0',

            'deskripsi' =>
                'nullable|string',

            'gambar' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $gambar = null;

        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar')
                ->store('produk', 'public');

        }


        Produk::create([

            'kategori_id' =>
                $request->kategori_id,

            'nama_produk' =>
                $request->nama_produk,

            'harga' =>
                $request->harga,

            'stok' =>
                $request->stok,

            'deskripsi' =>
                $request->deskripsi,

            'gambar' =>
                $gambar,

        ]);


        return redirect()
            ->route('produk.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan.'
            );

    }



    /*
    |--------------------------------------------------------------------------
    | DETAIL PRODUK
    |--------------------------------------------------------------------------
    */

    public function show(Produk $produk)
    {

        return redirect()
            ->route('produk.index');

    }



    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Produk $produk)
    {

        return redirect()
            ->route('produk.index');

    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUK
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Produk $produk
    ) {

        $request->validate([

            'kategori_id' =>
                'required|exists:kategoris,id',

            'nama_produk' =>
                'required|string|max:255',

            'harga' =>
                'required|numeric|min:0',

            'stok' =>
                'required|integer|min:0',

            'deskripsi' =>
                'nullable|string',

            'gambar' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $gambar = $produk->gambar;

        if ($request->hasFile('gambar')) {

            if (
                $produk->gambar &&
                Storage::disk('public')->exists($produk->gambar)
            ) {

                Storage::disk('public')
                    ->delete($produk->gambar);

            }

            $gambar = $request->file('gambar')
                ->store('produk', 'public');

        }


        $produk->update([

            'kategori_id' =>
                $request->kategori_id,

            'nama_produk' =>
                $request->nama_produk,

            'harga' =>
                $request->harga,

            'stok' =>
                $request->stok,

            'deskripsi' =>
                $request->deskripsi,

            'gambar' =>
                $gambar,

        ]);


        return redirect()
            ->route('produk.index')
            ->with(
                'success',
                'Produk berhasil diperbarui.'
            );

    }



    /*
    |--------------------------------------------------------------------------
    | HAPUS PRODUK
    |--------------------------------------------------------------------------
    */

    public function destroy(Produk $produk)
    {

        if (
            $produk->gambar &&
            Storage::disk('public')->exists($produk->gambar)
        ) {

            Storage::disk('public')
                ->delete($produk->gambar);

        }


        $produk->delete();


        return redirect()
            ->route('produk.index')
            ->with(
                'success',
                'Produk berhasil dihapus.'
            );

    }

}