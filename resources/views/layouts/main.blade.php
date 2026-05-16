@extends('layouts.main')

@section('content')

@if ($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="row mb-4">

    <div class="col-md-3">

        <div class="card p-4">

            <h5>Total Produk</h5>

            <h2>{{ $totalProduk }}</h2>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card p-4">

            <h5>Total Kategori</h5>

            <h2>{{ $totalKategori }}</h2>

        </div>

    </div>

</div>

<div class="card p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center">

        <h4>Data Produk</h4>

        <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#tambahProduk">

            + Tambah Produk

        </button>

    </div>

    <form class="mt-3">

        <input type="text"
               name="search"
               class="form-control"
               placeholder="Cari produk..."
               value="{{ request('search') }}">

    </form>

</div>

<div class="row">

@foreach($produks as $item)

<div class="col-md-4 mb-4">

    <div class="card p-3 h-100">

        @if($item->gambar)

            <img src="{{ asset('storage/'.$item->gambar) }}"
                 class="product-image">

        <!-- @elseif($item->gambar_link)

            <img src="{{ $item->gambar_link }}"
                 class="product-image"> -->

        @endif

        <div class="mt-3">

            <h5>{{ $item->nama_produk }}</h5>

            <span class="badge bg-primary">
                {{ $item->kategori->nama_kategori }}
            </span>

            <h4 class="mt-2">
                Rp {{ number_format($item->harga) }}
            </h4>

            <p class="text-muted">
                Stok: {{ $item->stok }}
            </p>

            <div class="d-flex gap-2">

                <button class="btn btn-warning w-100"
                        data-bs-toggle="modal"
                        data-bs-target="#edit{{ $item->id }}">

                    Edit

                </button>

                <form action="{{ route('produk.destroy', $item->id) }}"
                      method="POST"
                      class="w-100">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger w-100">
                        Delete
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- MODAL EDIT -->

<div class="modal fade"
     id="edit{{ $item->id }}">

<div class="modal-dialog">

<div class="modal-content">

<form action="{{ route('produk.update', $item->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="modal-header">

        <h5>Edit Produk</h5>

    </div>

    <div class="modal-body">

        <input type="text"
               name="nama_produk"
               class="form-control mb-3"
               value="{{ $item->nama_produk }}">

        <input type="number"
               name="harga"
               class="form-control mb-3"
               value="{{ $item->harga }}">

        <input type="number"
               name="stok"
               class="form-control mb-3"
               value="{{ $item->stok }}">

    </div>

    <div class="modal-footer">

        <button class="btn btn-success">
            Update
        </button>

    </div>

</form>

</div>

</div>

</div>

@endforeach

</div>

<div class="mt-4">

    {{ $produks->links() }}

</div>

<!-- MODAL TAMBAH -->

<div class="modal fade"
     id="tambahProduk">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form action="{{ route('produk.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="modal-header">

        <h5>Tambah Produk</h5>

    </div>

    <div class="modal-body">

        <select name="kategori_id"
                class="form-control mb-3">

            @foreach($kategoris as $kategori)

                <option value="{{ $kategori->id }}">
                    {{ $kategori->nama_kategori }}
                </option>

            @endforeach

        </select>

        <input type="text"
               name="nama_produk"
               class="form-control mb-3"
               placeholder="Nama Produk">

        <input type="number"
               name="harga"
               class="form-control mb-3"
               placeholder="Harga">

        <input type="number"
               name="stok"
               class="form-control mb-3"
               placeholder="Stok">

        <textarea name="deskripsi"
                  class="form-control mb-3"
                  placeholder="Deskripsi"></textarea>

        <input type="file"
               name="gambar"
               class="form-control mb-3"
               onchange="previewImage(event)">

        <img id="preview"
             width="120"
             class="rounded">

        <!-- kalo ada yg begini referensi project baru kalo untuk link <input type="text"
               name="gambar_link"
               class="form-control mt-3"
               placeholder="Atau Link Gambar"> -->

    </div>

    <div class="modal-footer">

        <button class="btn btn-primary">
            Simpan
        </button>

    </div>

</form>

</div>

</div>

</div>

<script>

function previewImage(event){

    const image = document.getElementById('preview');

    image.src = URL.createObjectURL(event.target.files[0]);

}

</script>

@endsection