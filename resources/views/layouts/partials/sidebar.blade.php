<div class="sidebar p-4 vh-100 bg-white shadow-sm">

    <!-- LOGO -->
    <div class="mb-5">

        <a href="{{ route('dashboard') }}"
           class="d-flex align-items-center gap-3 text-decoration-none">

            <img src="{{ asset('images/logo.png') }}"
                 alt="Logo"
                 width="55"
                 height="55"
                 class="rounded-circle shadow-sm">

            <div>

                <h5 class="fw-bold text-dark mb-0">
                    KChuu Bakery
                </h5>

                <small class="text-muted">
                    Smart Bakery Management
                </small>

            </div>

        </a>

    </div>

    <!-- MENU -->
    <div class="list-group list-group-flush">

        <a href="{{ route('dashboard') }}"
           class="list-group-item list-group-item-action border-0 rounded-3 mb-2 py-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}">

            <i class="fas fa-chart-pie me-2"></i>
            Dashboard
        </a>

        <a href="{{ route('kategori.index') }}"
           class="list-group-item list-group-item-action border-0 rounded-3 mb-2 py-3 {{ request()->routeIs('kategori.*') ? 'active' : '' }}">

            <i class="fas fa-tags me-2"></i>
            Kategori Produk
        </a>

        <a href="{{ route('produk.index') }}"
           class="list-group-item list-group-item-action border-0 rounded-3 py-3 {{ request()->routeIs('produk.*') ? 'active' : '' }}">

            <i class="fas fa-cookie-bite me-2"></i>
            Produk Bakery
        </a>

    </div>

</div>