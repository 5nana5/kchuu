@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-header {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border-radius: 24px;
        padding: 32px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        right: -40px;
        top: -40px;
        width: 180px;
        height: 180px;
        background: rgba(255,255,255,0.12);
        border-radius: 50%;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: -60px;
        right: 100px;
        width: 140px;
        height: 140px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .dashboard-title {
        position: relative;
        z-index: 2;
    }

    .dashboard-title h1 {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .dashboard-title p {
        font-size: 16px;
        opacity: 0.95;
        margin-bottom: 0;
    }

    .dashboard-card {
        border: none;
        border-radius: 22px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        background: rgba(245, 158, 11, 0.15);
        color: #d97706;
    }

    .stat-title {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .stat-number {
        font-size: 34px;
        font-weight: 800;
        color: #0f172a;
    }

    .chart-card {
        border: none;
        border-radius: 22px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .chart-title {
        font-weight: 700;
        color: #0f172a;
    }

    .clock-box h3 {
        font-size: 38px;
        font-weight: 800;
        color: #d97706;
    }

    .clock-box span {
        font-size: 15px;
        color: #64748b;
    }

    @media(max-width: 768px){

        .dashboard-title h1{
            font-size: 32px;
        }

        .clock-box{
            margin-top: 20px;
            text-align: start !important;
        }

    }
</style>


<!-- HEADER -->

<div class="dashboard-header mb-4">

    <div class="dashboard-title">

        <h1>
            Dashboard Admin
        </h1>

        <p>
            Selamat datang kembali👋
        </p>

    </div>

</div>


<!-- REALTIME CLOCK -->

<div class="card dashboard-card mb-4">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h5 class="fw-bold mb-1">
                Jam Berapa Sekarang?
            </h5>

            <p class="text-muted mb-0">
                Ingat, jangan lupa makan dan minum secukupnya yaa~            </p>
        </div>

        <div class="text-end clock-box">
            <h3 id="clock"></h3>
            <span id="date"></span>
        </div>

    </div>
</div>


<!-- STATISTIK -->

<div class="row g-4 mb-4">

    <!-- TOTAL PRODUK -->

    <div class="col-md-3">

        <div class="card dashboard-card h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <div class="stat-title">
                        Total Produk
                    </div>

                    <div class="stat-number">
                        {{ $produks->count() }}
                    </div>

                </div>

                <div class="stat-icon">
                    📦
                </div>

            </div>
        </div>

    </div>


    <!-- TOTAL STOK -->

    <div class="col-md-3">

        <div class="card dashboard-card h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <div class="stat-title">
                        Total Stok
                    </div>

                    <div class="stat-number">
                        {{ $produks->sum('stok') }}
                    </div>

                </div>

                <div class="stat-icon">
                    📊
                </div>

            </div>
        </div>

    </div>


    <!-- TOTAL TRANSAKSI PENJUALAN -->

    <div class="col-md-3">

        <div class="card dashboard-card h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <div class="stat-title">
                        Total Transaksi
                    </div>

                    <div class="stat-number">
                        {{ $totalTransaksi }}
                    </div>

                </div>

                <div class="stat-icon">
                    💳
                </div>

            </div>
        </div>

    </div>


    <!-- TOTAL PENDAPATAN -->

    <div class="col-md-3">

        <div class="card dashboard-card h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <div class="stat-title">
                        Total Pendapatan
                    </div>

                    <div class="stat-number">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </div>

                </div>

                <div class="stat-icon">
                    💰
                </div>

            </div>
        </div>

    </div>

</div>


<!-- SYSTEM INSIGHT -->

<div class="row g-4 mb-4">

    <div class="col-lg-6">

        <div class="card dashboard-card">

            <div class="card-body">

                <h5 class="fw-bold mb-3">💡 System Insight</h5>

                <div class="mb-3 p-3" style="background: #fef3c7; border-radius: 12px; border-left: 4px solid #f59e0b;">
                    <div style="font-weight: 600; color: #92400e; margin-bottom: 5px;">
                        Produk Stok Terendah
                    </div>
                    @if($produkStokTerendah)
                        <div style="color: #78350f; font-size: 13px;">
                            <strong>{{ $produkStokTerendah->nama_produk }}</strong> - Stok tersisa: <strong>{{ $produkStokTerendah->stok }}</strong> unit
                        </div>
                    @else
                        <div style="color: #78350f; font-size: 13px;">Tidak ada data produk</div>
                    @endif
                </div>

                <div class="p-3" style="background: #dbeafe; border-radius: 12px; border-left: 4px solid #3b82f6;">
                    <div style="font-weight: 600; color: #1e40af; margin-bottom: 5px;">
                        Produk Terlaris
                    </div>
                    @if($produkTerlaris)
                        <div style="color: #1e3a8a; font-size: 13px;">
                            <strong>{{ $produkTerlaris->nama_produk }}</strong> telah terjual <strong>{{ $produkTerlaris->sale_transactions_count }}</strong> kali
                        </div>
                    @else
                        <div style="color: #1e3a8a; font-size: 13px;">Belum ada transaksi penjualan</div>
                    @endif
                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-6">

        <div class="card dashboard-card">

            <div class="card-body">

                <h5 class="fw-bold mb-3">🎯 Recommendation by System</h5>

                <div class="mb-3 p-3" style="background: #fecaca; border-radius: 12px; border-left: 4px solid #ef4444;">
                    <div style="font-weight: 600; color: #7f1d1d; margin-bottom: 5px;">
                        ⚠️ Segera Restock
                    </div>
                    @if($produkStokTerendah && $produkStokTerendah->stok <= 10)
                        <div style="color: #450a0a; font-size: 13px;">
                            Stok <strong>{{ $produkStokTerendah->nama_produk }}</strong> hanya tersisa <strong>{{ $produkStokTerendah->stok }}</strong> unit. Lakukan restock segera untuk mencegah kehabisan stok.
                        </div>
                    @else
                        <div style="color: #450a0a; font-size: 13px;">
                            Stok produk dalam kondisi aman.
                        </div>
                    @endif
                </div>

                <div class="p-3" style="background: #bbf7d0; border-radius: 12px; border-left: 4px solid #10b981;">
                    <div style="font-weight: 600; color: #065f46; margin-bottom: 5px;">
                        ✨ Tingkatkan Promosi
                    </div>
                    @if($produkTerlaris)
                        <div style="color: #064e3b; font-size: 13px;">
                            <strong>{{ $produkTerlaris->nama_produk }}</strong> adalah produk terlaris. Pertimbangkan untuk meningkatkan promosi atau stok produk ini.
                        </div>
                    @else
                        <div style="color: #064e3b; font-size: 13px;">
                            Belum ada data penjualan untuk memberikan rekomendasi.
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>

</div>

<div class="row g-4">

    <!-- CHART KATEGORI -->

    <div class="col-lg-6">

        <div class="card chart-card h-100">

            <div class="card-body">

                <h5 class="chart-title mb-4">
                    Penjualan per Kategori
                </h5>

                <canvas id="kategoriChart"></canvas>

            </div>

        </div>

    </div>


    <!-- CHART STOK -->

    <div class="col-lg-6">

        <div class="card chart-card h-100">

            <div class="card-body">

                <h5 class="chart-title mb-4">
                    Persentase Stok Produk
                </h5>

                <canvas id="stokChart"></canvas>

            </div>

        </div>

    </div>

</div>

@endsection



@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // =========================
    // REALTIME CLOCK
    // =========================

    function updateClock() {

        const now = new Date();

        document.getElementById('clock').innerHTML =
            now.toLocaleTimeString('id-ID');

        document.getElementById('date').innerHTML =
            now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

    }

    updateClock();

    setInterval(updateClock, 1000);



    // =========================
    // CHART KATEGORI
    // =========================

    const kategoriChart = document.getElementById('kategoriChart');

    if (kategoriChart) {

        new Chart(kategoriChart, {

            type: 'bar',

            data: {

                labels: [
                    @foreach($penjualanKategori as $kategori)
                        '{{ $kategori->nama_kategori }}',
                    @endforeach
                ],

datasets: [{

    label: 'Jumlah Penjualan',

    data: [
        @foreach($penjualanKategori as $kategori)
            {{ $kategori->total_penjualan }},
        @endforeach
    ],

                    backgroundColor: [
                        '#8B4513',
                        '#D2691E',
                        '#CD853F',
                        '#DEB887',
                        '#F5DEB3',
                        '#D2B48C'
                    ],

                    borderRadius: 10,
                    borderWidth: 0

                }]
            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        display: false
                    }

                },

                scales: {

                    y: {
                        beginAtZero: true
                    }

                }

            }

        });

    }



    // =========================
    // CHART STOK
    // =========================

    const stokChart = document.getElementById('stokChart');

    if (stokChart) {

        new Chart(stokChart, {

            type: 'doughnut',

            data: {

                labels: [
                    @foreach($produks as $produk)
                        '{{ $produk->nama_produk }}',
                    @endforeach
                ],

                datasets: [{

                    label: 'Stok',

                    data: [
                        @foreach($produks as $produk)
                            {{ $produk->stok }},
                        @endforeach
                    ],

                    backgroundColor: [
                        '#8B4513',
                        '#D2691E',
                        '#CD853F',
                        '#3B82F6',
                        '#10B981',
                        '#F59E0B',
                        '#EC4899',
                        '#6366F1',
                        '#14B8A6',
                        '#F97316'
                    ],

                    borderWidth: 0

                }]
            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        position: 'top'
                    }

                }

            }

        });

    }

});

</script>

@endpush