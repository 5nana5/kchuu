<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN SEMUA KATEGORI
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $kategoris = Kategori::with('produks')
            ->latest()
            ->get();

        return view(
            'kategori.index',
            compact('kategoris')
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
            ->route('kategori.index');
    }



    /*
    |--------------------------------------------------------------------------
    | SIMPAN KATEGORI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'nama_kategori' =>
                'required|string|max:255'

        ], [

            'nama_kategori.required' =>
                'Nama kategori wajib diisi.',

            'nama_kategori.max' =>
                'Nama kategori terlalu panjang.'

        ]);


        Kategori::create([

            'nama_kategori' =>
                $request->nama_kategori

        ]);


        return redirect()
            ->route('kategori.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan.'
            );
    }



    /*
    |--------------------------------------------------------------------------
    | DETAIL KATEGORI
    |--------------------------------------------------------------------------
    */

    public function show(Kategori $kategori)
    {
        $kategori->load('produks');

        return view(
            'kategori.show',
            compact('kategori')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Kategori $kategori)
    {
        return redirect()
            ->route('kategori.index');
    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE KATEGORI
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Kategori $kategori
    ) {

        $request->validate([

            'nama_kategori' =>
                'required|string|max:255'

        ], [

            'nama_kategori.required' =>
                'Nama kategori wajib diisi.',

            'nama_kategori.max' =>
                'Nama kategori terlalu panjang.'

        ]);


        $kategori->update([

            'nama_kategori' =>
                $request->nama_kategori

        ]);


        return redirect()
            ->route('kategori.index')
            ->with(
                'success',
                'Kategori berhasil diperbarui.'
            );
    }



    /*
    |--------------------------------------------------------------------------
    | HAPUS KATEGORI
    |--------------------------------------------------------------------------
    */

    public function destroy(Kategori $kategori)
    {

        if ($kategori->produks()->count() > 0) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Kategori tidak dapat dihapus karena masih memiliki produk.'
                );

        }


        $kategori->delete();


        return redirect()
            ->route('kategori.index')
            ->with(
                'success',
                'Kategori berhasil dihapus.'
            );
    }

}