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
            Selamat datang kembali, {{ Auth::user()->name }} 👋
        </p>

    </div>

</div>


<!-- REALTIME CLOCK -->

<div class="card dashboard-card mb-4">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h5 class="fw-bold mb-1">
                Waktu Realtime
            </h5>

            <p class="text-muted mb-0">
                Jam dan tanggal otomatis sistem.
            </p>
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

    <div class="col-md-4">

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


    <!-- TOTAL KATEGORI -->

    <div class="col-md-4">

        <div class="card dashboard-card h-100">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <div class="stat-title">
                        Total Kategori
                    </div>

                    <div class="stat-number">
                        {{ $kategoris->count() }}
                    </div>

                </div>

                <div class="stat-icon">
                    🏷️
                </div>

            </div>
        </div>

    </div>


    <!-- TOTAL STOK -->

    <div class="col-md-4">

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

</div>


<!-- CHART -->

<div class="row g-4">

    <!-- CHART KATEGORI -->

    <div class="col-lg-6">

        <div class="card chart-card h-100">

            <div class="card-body">

                <h5 class="chart-title mb-4">
                    Produk per Kategori
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
                    @foreach($kategoris as $kategori)
                        '{{ $kategori->nama_kategori }}',
                    @endforeach
                ],

                datasets: [{

                    label: 'Jumlah Produk',

                    data: [
                        @foreach($kategoris as $kategori)
                            {{ $kategori->produks->count() }},
                        @endforeach
                    ],

                    backgroundColor: [
                        '#f59e0b',
                        '#fb923c',
                        '#fbbf24',
                        '#fdba74',
                        '#fcd34d'
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
                        '#f59e0b',
                        '#fb923c',
                        '#fbbf24',
                        '#fdba74',
                        '#fcd34d',
                        '#fed7aa'
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