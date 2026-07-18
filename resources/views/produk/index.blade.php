@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<style>

    .product-header{
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border-radius: 24px;
        padding: 28px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .product-header::before{
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
        top: -60px;
        right: -40px;
    }

    .custom-card{
        border: none;
        border-radius: 22px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .table tbody tr{
        transition: 0.2s ease;
    }

    .table tbody tr:hover{
        background: #fffbf5;
    }

    .table td,
    .table th{
        vertical-align: middle;
    }

    .product-image{
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 16px;
        border: 3px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .btn-action{
        border-radius: 12px;
        padding: 6px 14px;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .btn-action:hover{
        transform: translateY(-1px);
    }

    .modal-content{
        border-radius: 24px;
    }

    .form-control,
    .form-select{
        border-radius: 14px;
        padding: 12px 14px;
    }

    .btn-primary{
        background: #f59e0b;
        border: none;
    }

    .btn-primary:hover{
        background: #d97706;
    }

    .badge-stock{
        background: rgba(245, 158, 11, 0.18);
        color: #b45309;
        padding: 8px 14px;
        border-radius: 999px;
        font-weight: 600;
    }

    .badge-category{
        background: rgba(59, 130, 246, 0.15);
        color: #2563eb;
        padding: 8px 14px;
        border-radius: 999px;
        font-weight: 600;
    }

    small.text-muted{
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

</style>



<!-- HEADER -->

<div class="product-header mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h2 class="fw-bold mb-2">
                Data Produk
            </h2>

            <p class="mb-0 opacity-75">
                Kelola produk bakery KChuu dengan lebih mudah dan modern.
            </p>

        </div>

        <button class="btn btn-light rounded-4 px-4 fw-semibold shadow-sm"
                data-bs-toggle="modal"
                data-bs-target="#createProductModal">

            <i class="fas fa-plus me-2"></i>

            Tambah Produk

        </button>

    </div>

</div>


<!-- FILTER KATEGORI -->

<div class="mb-4 d-flex flex-wrap gap-2">

    <a href="{{ route('produk.index') }}"
       class="btn btn-outline-warning rounded-pill">

        Semua

    </a>

    @foreach($kategoris as $kategori)

    <a href="{{ route('produk.index', ['kategori' => $kategori->id]) }}"
       class="btn btn-outline-warning rounded-pill">

        {{ $kategori->nama_kategori }}

    </a>

    @endforeach

</div>


<!-- ALERT -->

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show border-0 rounded-4 shadow-sm">

    <i class="fas fa-circle-check me-2"></i>

    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif


@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show border-0 rounded-4 shadow-sm">

    <i class="fas fa-circle-exclamation me-2"></i>

    {{ session('error') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif

<!-- TABLE PRODUK -->

<div class="card custom-card">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="70" class="ps-4">
                            No
                        </th>

                        <th width="120">
                            Gambar
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Harga
                        </th>

                        <th>
                            Stok
                        </th>

                        <th width="180" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                @forelse($produks as $produk)


                    <tr>


                        <td class="ps-4 fw-semibold">

                            {{ $loop->iteration }}

                        </td>



                        <td>

                            @if($produk->gambar)

                                <img src="{{ asset('storage/'.$produk->gambar) }}"
                                     class="product-image">

                            @else

                                <div class="text-muted small">
                                    Tidak ada gambar
                                </div>

                            @endif

                        </td>



                        <td>

                            <div class="fw-semibold">

                                {{ $produk->nama_produk }}

                            </div>


                            <small class="text-muted">

                                {{ $produk->deskripsi }}

                            </small>

                        </td>



                        <td>

                            <span class="badge-category">

                                {{ $produk->kategori->nama_kategori ?? '-' }}

                            </span>

                        </td>



                        <td>

                            Rp {{ number_format($produk->harga,0,',','.') }}

                        </td>



                        <td>

                            <span class="badge-stock">

                                {{ $produk->stok }}

                            </span>

                        </td>



                        <td>

                            <div class="d-flex justify-content-center gap-2">


                                <button type="button"
                                        class="btn btn-warning btn-sm btn-action btn-edit-product"

                                        data-id="{{ $produk->id }}"
                                        data-nama="{{ $produk->nama_produk }}"
                                        data-kategori="{{ $produk->kategori_id }}"
                                        data-harga="{{ $produk->harga }}"
                                        data-deskripsi="{{ $produk->deskripsi }}"
                                        data-gambar="{{ $produk->gambar }}"

                                        data-bs-toggle="modal"
                                        data-bs-target="#editProductModal">

                                    <i class="fas fa-pen"></i>

                                </button>



                                <form action="{{ route('produk.destroy',$produk->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')


                                    <button type="submit"
                                            class="btn btn-danger btn-sm btn-action"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>


                                </form>


                            </div>

                        </td>


                    </tr>


                @empty


                    <tr>

                        <td colspan="7"
                            class="text-center text-muted py-5">

                            Belum ada produk.

                        </td>

                    </tr>


                @endforelse


                </tbody>


            </table>

        </div>

    </div>

</div>

<!-- MODAL TAMBAH PRODUK -->

<div class="modal fade"
     id="createProductModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold">
                    Tambah Produk
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form action="{{ route('produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Nama Produk
                            </label>

                            <input type="text"
                                   name="nama_produk"
                                   class="form-control"
                                   required>

                            @error('nama_produk')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Kategori
                            </label>

                            <select name="kategori_id"
                                    class="form-select"
                                    required>

                                <option value="">
                                    Pilih Kategori
                                </option>

                                @foreach($kategoris as $kategori)

                                <option value="{{ $kategori->id }}">
                                    {{ $kategori->nama_kategori }}
                                </option>

                                @endforeach

                            </select>

                            @error('kategori_id')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Harga
                            </label>

                            <input type="number"
                                   name="harga"
                                   class="form-control"
                                   min="0"
                                   required>

                            @error('harga')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            @error('stok')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea name="deskripsi"
                                      class="form-control"
                                      rows="3"></textarea>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Upload Gambar
                            </label>

                            <input type="file"
                                   name="gambar"
                                   class="form-control"
                                   accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted">
                                Format: JPG, JPEG, PNG, WEBP (Maks. 2 MB)
                            </small>

                            @error('gambar')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="button"
                            class="btn btn-light rounded-3"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit"
                            class="btn btn-primary rounded-3 px-4">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- MODAL EDIT PRODUK -->

<div class="modal fade"
     id="editProductModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold">
                    Edit Produk
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form id="productEditForm"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Nama Produk
                            </label>

                            <input type="text"
                                   name="nama_produk"
                                   class="form-control"
                                   required>

                            @error('nama_produk')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Kategori
                            </label>

                            <select name="kategori_id"
                                    class="form-select"
                                    required>

                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach

                            </select>

                            @error('kategori_id')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Harga
                            </label>

                            <input type="number"
                                   name="harga"
                                   class="form-control"
                                   min="0"
                                   required>

                            @error('harga')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Stok
                            </label>

                            <input type="number"
                                   name="stok"
                                   class="form-control"
                                   min="0"
                                   required>

                            @error('stok')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea name="deskripsi"
                                      class="form-control"
                                      rows="3"></textarea>

                        </div>

                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Gambar Produk
                            </label>

                            <input type="file"
                                   name="gambar"
                                   class="form-control"
                                   accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted d-block mt-2">
                                Format: JPG, JPEG, PNG, WEBP (Maks. 2 MB)
                            </small>

                            <small class="text-muted d-block">
                                Gambar saat ini:
                                <span id="old-image-name">
                                    Belum ada gambar
                                </span>
                            </small>

                            @error('gambar')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="button"
                            class="btn btn-light rounded-3"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn btn-primary rounded-3 px-4">
                        Update
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', () => {

    const productEditForm = document.getElementById('productEditForm');
    const buttons = document.querySelectorAll('.btn-edit-product');

    buttons.forEach(button => {

        button.addEventListener('click', () => {

            const id = button.dataset.id || '';
            const nama = button.dataset.nama || '';
            const kategori = button.dataset.kategori || '';
            const harga = button.dataset.harga || '';
            const stok = button.dataset.stok || '';
            const deskripsi = button.dataset.deskripsi || '';

            productEditForm.action = `{{ url('produk') }}/${id}`;

            productEditForm.querySelector('[name="nama_produk"]').value = nama;
            productEditForm.querySelector('[name="kategori_id"]').value = kategori;
            productEditForm.querySelector('[name="harga"]').value = harga;
            productEditForm.querySelector('[name="stok"]').value = stok;
            productEditForm.querySelector('[name="deskripsi"]').value = deskripsi;

            // Tampilkan nama gambar lama jika ada
            const oldImage = document.getElementById('old-image-name');

            if (oldImage) {
                oldImage.textContent = button.dataset.gambar
                    ? button.dataset.gambar.split('/').pop()
                    : 'Belum ada gambar';
            }

        });

    });

});
</script>

@endpush
