@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h2 class="fw-bold mb-4">
        Tambah Transaksi Penjualan
    </h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('sale-transactions.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Produk</label>

                    <select name="produk_id" class="form-select" required>

                        <option value="">-- Pilih Produk --</option>

                        @foreach($produks as $produk)
                            <option value="{{ $produk->id }}">
                                {{ $produk->nama_produk }}
                                (Stok: {{ $produk->stok }})
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>

                    <input
                        type="number"
                        name="qty"
                        class="form-control"
                        min="1"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Merchant Code</label>

                    <input
                        type="text"
                        name="merchant_code"
                        class="form-control"
                        placeholder="Contoh: SHOPEE01"
                        required>
                </div>

                <button class="btn btn-warning text-white">
                    <i class="fas fa-save me-1"></i>
                    Simpan Transaksi
                </button>

                <a href="{{ route('sale-transactions.index') }}"
                   class="btn btn-secondary">
                    Batal
                </a>

            </form>

        </div>

    </div>

</div>
@endsection