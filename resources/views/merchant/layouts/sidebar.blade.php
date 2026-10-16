<aside class="merchant-sidebar d-flex flex-column">
    {{-- Logo --}}
    <div class="p-4 border-bottom" style="border-color: var(--border) !important;">
        <a href="{{ route('merchant.dashboard') }}"
           class="text-decoration-none d-flex align-items-center gap-2">
            <span class="d-flex align-items-center justify-content-center rounded-3"
                  style="width: 42px; height: 42px; background: var(--primary-light); color: var(--primary);">
                <i class="bi bi-shop-window fs-4"></i>
            </span>

            <span>
                <strong style="font-family: 'Poppins', sans-serif; color: var(--primary); font-size: 20px;">
                    Marketplace Katering
                </strong>
            </span>
        </a>
    </div>

    {{-- Menu Navigasi --}}
    <nav class="p-3 flex-grow-1">
        <small class="text-uppercase fw-semibold px-3 d-block mb-2"
               style="color: var(--muted); font-size: 11px; letter-spacing: 1px;">
            Menu Utama
        </small>

        {{-- Dashboard --}}
        <a href="{{ route('merchant.dashboard') }}"
           class="merchant-nav-link {{ request()->routeIs('merchant.dashboard') ? 'merchant-nav-active' : '' }}">
            <i class="bi bi-grid-1x2 fs-5"></i>
            <span>Dashboard</span>
        </a>

        {{-- Profil Usaha --}}
        <a href="{{ route('merchant.profile.index') }}"
           class="merchant-nav-link {{ request()->routeIs('merchant.profile.*') ? 'merchant-nav-active' : '' }}">
            <i class="bi bi-building fs-5"></i>
            <span>Profil Usaha</span>
        </a>

        {{-- Kategori Menu --}}
        <a href="{{ route('merchant.categories.index') }}"
           class="merchant-nav-link {{ request()->routeIs('merchant.categories.*') ? 'merchant-nav-active' : '' }}">
            <i class="bi bi-tags fs-5"></i>
            <span>Kategori Menu</span>
        </a>

        {{-- Menu Katering --}}
        <a href="{{ route('merchant.menus.index') }}"
           class="merchant-nav-link {{ request()->routeIs('merchant.menus.*') ? 'merchant-nav-active' : '' }}">
            <i class="bi bi-journal-richtext fs-5"></i>
            <span>Menu Katering</span>
        </a>

        {{-- Pesanan --}}
        <a href="{{ route('merchant.orders.index') }}"
           class="merchant-nav-link {{ request()->routeIs('merchant.orders.*') ? 'merchant-nav-active' : '' }}">
            <i class="bi bi-bag-check fs-5"></i>
            <span>Pesanan</span>
        </a>
    </nav>

    {{-- Tombol Logout --}}
    <div class="p-3 mt-auto" style="border-top: 1px solid var(--border);">
        <button type="button"
                class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2"
                data-bs-toggle="modal"
                data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </button>
    </div>
</aside>

{{-- Modal Logout: letakkan di luar aside --}}
<div class="modal fade" id="logoutModal" tabindex="-1"
     aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content logout-modal-content">
            <div class="modal-body p-4 p-md-5 text-center">

                <div class="logout-icon mb-4">
                    <i class="bi bi-box-arrow-right"></i>
                </div>

                <h5 class="logout-modal-title mb-2" id="logoutModalLabel">
                    Keluar dari akun?
                </h5>

                <p class="logout-modal-text mb-4">
                    Apakah kamu yakin ingin keluar dari akun merchant?
                    Kamu perlu login kembali untuk mengakses dashboard.
                </p>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button"
                            class="btn logout-cancel-btn"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn logout-confirm-btn">
                            Ya, Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
