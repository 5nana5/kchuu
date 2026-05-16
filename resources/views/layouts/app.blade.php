<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'KChuu Bakery')
    </title>

    <!-- BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- FONT AWESOME -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        body{
            margin: 0;
            background: #f5f7fb;
            overflow-x: hidden;
            font-family: 'Segoe UI', sans-serif;
        }

        .main-wrapper{
            display: flex;
            min-height: 100vh;
        }

        .sidebar{
            width: 260px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #e5e7eb;
        }

        .content-area{
            flex: 1;
            padding: 25px;
        }

        .navbar-custom{
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e5e7eb;
            padding: 14px 24px;
        }

        .card{
            border: none;
            border-radius: 18px;
        }

        .list-group-item{
            border: none;
            border-radius: 12px !important;
            margin-bottom: 8px;
            transition: 0.2s ease;
            font-weight: 500;
        }

        .list-group-item:hover{
            background: #fff3e0;
            color: #d97706;
        }

        .list-group-item.active{
            background: #d97706 !important;
            color: white !important;
        }

        .table{
            vertical-align: middle;
        }

    </style>

</head>

@php
    $backgroundUrl = $backgroundUrl ?? null;
@endphp

<body

@if(!empty($backgroundUrl))

    style="
        background-image: url('{{ $backgroundUrl }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    "

@endif

>

    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">

        <div class="container-fluid">

            <div class="d-flex align-items-center">

                <i class="fas fa-bread-slice text-warning me-3 fs-4"></i>

                <div>

                    <div class="fw-bold">
                        KChuu Bakery Admin
                    </div>

                    <small class="text-muted">
                        Nanda Rahayu Widiyanti - 411232038
                    </small>

                </div>

            </div>

            <div class="d-flex align-items-center">

                <span class="text-muted me-3">

                    {{ Auth::user()->name ?? 'Administrator' }}

                </span>

                <a href="{{ route('logout') }}"
                   class="btn btn-outline-secondary btn-sm"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">

                    <i class="fas fa-sign-out-alt me-1"></i>

                    Logout

                </a>

                <form id="logout-form"
                      action="{{ route('logout') }}"
                      method="POST"
                      class="d-none">

                    @csrf

                </form>

            </div>

        </div>

    </nav>



    <!-- MAIN -->

    <div class="main-wrapper">

        <!-- SIDEBAR -->

        @include('layouts.partials.sidebar')



        <!-- CONTENT -->

        <main class="content-area">

            @include('layouts.partials.alerts')

            @yield('content')

            {{ $slot ?? '' }}

        </main>

    </div>



<!-- BOOTSTRAP JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')


<!-- FOOTER -->

<footer class="text-center py-3 text-muted small bg-white border-top">

    © 2026 KChuu Bakery System |
    Developed by Nana'S |
    Universitas Dian Nusantara

</footer>

</body>

</html>