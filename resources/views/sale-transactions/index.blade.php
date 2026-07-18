@extends('layouts.app')

@section('title', 'Transaksi Penjualan')

@section('content')

<style>

    .transaction-header{
        background: linear-gradient(135deg,#f59e0b,#d97706);
        border-radius:24px;
        padding:28px;
        color:white;
        position:relative;
        overflow:hidden;
        box-shadow:0 10px 25px rgba(0,0,0,.08);
    }

    .transaction-header::before{
        content:'';
        position:absolute;
        width:180px;
        height:180px;
        border-radius:50%;
        background:rgba(255,255,255,.08);
        top:-60px;
        right:-40px;
    }

    .custom-card{
        border:none;
        border-radius:22px;
        box-shadow:0 4px 20px rgba(0,0,0,.05);
        overflow:hidden;
    }

    .table tbody tr:hover{
        background:#fffaf0;
    }

    .table td,
    .table th{
        vertical-align:middle;
    }

    .search-box{
        max-width:320px;
    }

</style>

<div class="transaction-header mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h2 class="fw-bold mb-2">
                Transaksi Penjualan
            </h2>

            <p class="mb-0 opacity-75">
                Kelola seluruh transaksi penjualan KChuu Bakery.
            </p>

        </div>

        <div class="d-flex gap-2 flex-wrap">

            <a href="{{ route('sale-transactions.export.excel') }}"
               class="btn btn-success rounded-3">

                <i class="fas fa-file-excel me-2"></i>
                Excel

            </a>

            <a href="{{ route('sale-transactions.export.pdf') }}"
               class="btn btn-danger rounded-3">

                <i class="fas fa-file-pdf me-2"></i>
                PDF

            </a>

            <a href="{{ route('sale-transactions.create') }}"
               class="btn btn-light rounded-3">

                <i class="fas fa-plus me-2"></i>
                Tambah Transaksi

            </a>

        </div>

    </div>

</div>



@if(session('success'))

<div class="alert alert-success rounded-4 shadow-sm">

    {{ session('success') }}

</div>

@endif



@if(session('error'))

<div class="alert alert-danger rounded-4 shadow-sm">

    {{ session('error') }}

</div>

@endif



<div class="d-flex justify-content-end mb-3">

    <input
        type="text"
        id="searchTransaction"
        class="form-control search-box"
        placeholder="Cari nomor transaksi, produk, merchant...">

</div>



<div class="card custom-card">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light text-center">

                    <tr>

                        <th>No Transaksi</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Merchant Code</th>

                    </tr>

                </thead>

                <tbody id="transactionTable">

                @forelse($transactions as $transaction)

                    <tr class="text-center">

                        <td>
                            {{ $transaction->transaction_number }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                        </td>

                        <td>
                            {{ $transaction->produk->nama_produk }}
                        </td>

                        <td>
                            {{ $transaction->qty }}
                        </td>

                        <td>
                            Rp {{ number_format($transaction->harga,0,',','.') }}
                        </td>

                        <td class="fw-semibold">
                            Rp {{ number_format($transaction->total,0,',','.') }}
                        </td>

                        <td>

                            <span class="badge bg-warning text-dark">

                                {{ $transaction->merchant_code }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-5 text-muted">

                            Belum ada transaksi.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

const search = document.getElementById('searchTransaction');

search.addEventListener('keyup', function(){

    let value = this.value.toLowerCase();

    document.querySelectorAll('#transactionTable tr').forEach(function(row){

        row.style.display =
            row.innerText.toLowerCase().includes(value)
            ? ''
            : 'none';

    });

});

</script>

@endpush