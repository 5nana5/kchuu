@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

<style>

    .kategori-header{
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border-radius: 24px;
        padding: 28px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .kategori-header::before{
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

    .table tbody tr:hover{
        background: #fffbf5;
    }

    .btn-action{
        border-radius: 12px;
        padding: 6px 14px;
        font-size: 14px;
        font-weight: 600;
    }

    .form-control{
        border-radius: 14px;
        padding: 12px 14px;
    }

    .modal-content{
        border-radius: 24px;
    }

</style>



<!-- HEADER -->

<div class="kategori-header mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h2 class="fw-bold mb-2">
                Data Kategori
            </h2>

            <p class="mb-0 opacity-75">
                Kelola kategori produk bakery dengan mudah.
            </p>

        </div>

        <button class="btn btn-light rounded-4 px-4 fw-semibold shadow-sm"
                data-bs-toggle="modal"
                data-bs-target="#createKategoriModal">

            <i class="fas fa-plus me-2"></i>
            Tambah Kategori

        </button>

    </div>

</div>



<!-- ALERT -->

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show border-0 rounded-4 shadow-sm">

    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif


@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show border-0 rounded-4 shadow-sm">

    {{ session('error') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif



<!-- TABLE -->

<div class="card custom-card">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="80" class="ps-4">
                            No
                        </th>

                        <th>
                            Nama Kategori
                        </th>

                        <th width="220" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($kategoris as $kategori)

                    <tr>

                        <td class="ps-4 fw-semibold">

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            <div class="fw-semibold">

                                {{ $kategori->nama_kategori }}

                            </div>

                            <small class="text-muted">

                                {{ $kategori->produks->count() }} produk

                            </small>

                        </td>

                        <td>

                            <div class="d-flex justify-content-center gap-2">

                                <!-- EDIT -->

                                <button
                                    class="btn btn-warning btn-sm btn-action btn-edit-kategori"

                                    data-id="{{ $kategori->id }}"
                                    data-nama="{{ $kategori->nama_kategori }}"

                                    data-bs-toggle="modal"
                                    data-bs-target="#editKategoriModal">

                                    <i class="fas fa-pen"></i>

                                </button>


                                <!-- DELETE -->

                                <form action="{{ route('kategori.destroy', $kategori->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm btn-action"
                                            onclick="return confirm('Hapus kategori ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3"
                            class="text-center text-muted py-5">

                            Belum ada kategori.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>





<!-- MODAL TAMBAH -->

<div class="modal fade"
     id="createKategoriModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold">

                    Tambah Kategori

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form action="{{ route('kategori.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body">

                    <label class="form-label fw-semibold">

                        Nama Kategori

                    </label>

                    <input type="text"
                           name="nama_kategori"
                           class="form-control"
                           required>

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





<!-- MODAL EDIT -->

<div class="modal fade"
     id="editKategoriModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold">

                    Edit Kategori

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form id="kategoriEditForm"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <label class="form-label fw-semibold">

                        Nama Kategori

                    </label>

                    <input type="text"
                           name="nama_kategori"
                           class="form-control"
                           required>

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

    const kategoriEditForm =
        document.getElementById('kategoriEditForm');

    const buttons =
        document.querySelectorAll('.btn-edit-kategori');

    buttons.forEach(button => {

        button.addEventListener('click', () => {

            const id =
                button.dataset.id;

            const nama =
                button.dataset.nama;

            kategoriEditForm.action =
                `{{ url('kategori') }}/${id}`;

            kategoriEditForm.querySelector(
                '[name="nama_kategori"]'
            ).value = nama;

        });

    });

});

</script>

@endpush