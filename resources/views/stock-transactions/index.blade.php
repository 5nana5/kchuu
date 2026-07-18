@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')

<style>

    .stock-header{
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border-radius: 24px;
        padding: 28px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }


    .stock-header::before{
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


    .form-control,
    .form-select{
        border-radius: 14px;
        padding: 12px 14px;
    }


    .form-control:focus,
    .form-select:focus{
        border-color: #f59e0b;
        box-shadow: 0 0 0 .2rem rgba(245,158,11,.15);
    }


    .btn-primary{
        background: #f59e0b;
        border: none;
        border-radius: 14px;
        padding: 10px 24px;
        font-weight: 600;
    }


    .btn-primary:hover{
        background: #d97706;
    }


    .btn-light{
        border-radius: 14px;
        padding: 10px 24px;
        font-weight: 600;
    }


</style>



<!-- HEADER -->

<div class="stock-header mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h2 class="fw-bold mb-2">
                Tambah Barang Masuk
            </h2>

            <p class="mb-0 opacity-75">
                Catat penambahan stok produk bakery KChuu.
            </p>

        </div>


        <a href="{{ route('stock-transactions.index') }}"
           class="btn btn-light shadow-sm">

            <i class="fas fa-arrow-left me-2"></i>

            Kembali

        </a>


    </div>

</div>




<!-- FORM -->

<div class="card custom-card">

    <div class="card-body p-4">


        <form action="{{ route('stock-transactions.store') }}"
              method="POST">

            @csrf



            <!-- PRODUK -->

            <div class="mb-4">

                <label class="form-label fw-semibold">

                    Produk

                </label>


                <select name="produk_id"
                        class="form-select"
                        required>


                    <option value="">

                        -- Pilih Produk --

                    </option>



                    @foreach($produks as $produk)

                        <option value="{{ $produk->id }}">

                            {{ $produk->nama_produk }}

                        </option>

                    @endforeach


                </select>



                @error('produk_id')

                    <div class="text-danger small mt-2">

                        {{ $message }}

                    </div>

                @enderror


            </div>





            <!-- JUMLAH -->

            <div class="mb-4">

                <label class="form-label fw-semibold">

                    Jumlah Barang Masuk

                </label>


                <input type="number"
                       name="qty"
                       class="form-control"
                       min="1"
                       placeholder="Contoh: 50"
                       required>



                @error('qty')

                    <div class="text-danger small mt-2">

                        {{ $message }}

                    </div>

                @enderror


            </div>





            <!-- BUTTON -->

            <div class="d-flex justify-content-end gap-2">


                <a href="{{ route('stock-transactions.index') }}"
                   class="btn btn-light">

                    Batal

                </a>



                <button type="submit"
                        class="btn btn-primary">

                    <i class="fas fa-save me-2"></i>

                    Simpan Barang Masuk

                </button>


            </div>


        </form>


    </div>

</div>


@endsection