<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Laporan Transaksi Penjualan
    </title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table,
        th,
        td{
            border:1px solid #000;
        }

        th{
            background:#eeeeee;
        }

        th,
        td{
            padding:8px;
            text-align:center;
        }

    </style>

</head>

<body>

<h2>
    Laporan Transaksi Penjualan
</h2>

<table>

    <thead>

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

    <tbody>

    @foreach($transactions as $transaction)

        <tr>

            <td>{{ $transaction->transaction_number }}</td>

            <td>{{ $transaction->transaction_date }}</td>

            <td>{{ $transaction->produk->nama_produk }}</td>

            <td>{{ $transaction->qty }}</td>

            <td>
                Rp {{ number_format($transaction->harga,0,',','.') }}
            </td>

            <td>
                Rp {{ number_format($transaction->total,0,',','.') }}
            </td>

            <td>{{ $transaction->merchant_code }}</td>

        </tr>

    @endforeach

    </tbody>

</table>

</body>

</html>