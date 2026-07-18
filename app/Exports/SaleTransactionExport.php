<?php

namespace App\Exports;

use App\Models\SaleTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SaleTransactionExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return SaleTransaction::with('produk')
            ->get()
            ->map(function ($transaction) {

                return [
                    'Nomor Transaksi' => $transaction->transaction_number,
                    'Tanggal' => $transaction->transaction_date,
                    'Produk' => $transaction->produk->nama_produk,
                    'Qty' => $transaction->qty,
                    'Harga' => $transaction->harga,
                    'Total' => $transaction->total,
                    'Merchant Code' => $transaction->merchant_code,
                ];

            });
    }

    public function headings(): array
    {
        return [
            'Nomor Transaksi',
            'Tanggal',
            'Produk',
            'Qty',
            'Harga',
            'Total',
            'Merchant Code',
        ];
    }
}