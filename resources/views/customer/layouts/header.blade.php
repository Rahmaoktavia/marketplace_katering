<nav class="navbar navbar-expand-lg customer-navbar sticky-top">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand customer-brand d-flex align-items-center gap-2"
           href="{{ route('customer.dashboard') }}">
            <span class="customer-brand-icon">
                <i class="bi bi-shop-window"></i>
            </span>

            <span class="customer-brand-name">
                Marketplace Katering
            </span>
        </a>

        {{-- Toggle Mobile --}}
        <button class="navbar-toggler customer-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#customerNavbar"
                aria-controls="customerNavbar"
                aria-expanded="false"
                aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="customerNavbar">

            {{-- Menu Navigasi --}}
            <ul class="navbar-nav customer-nav-links">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}"
                       href="{{ route('customer.dashboard') }}"
                       @if (request()->routeIs('customer.dashboard')) aria-current="page" @endif>
                        <i class="bi bi-house-door me-2"></i>
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.caterings.*') ? 'active' : '' }}"
                       href="{{ route('customer.caterings.index') }}"
                       @if (request()->routeIs('customer.caterings.*')) aria-current="page" @endif>
                        <i class="bi bi-search me-2"></i>
                        Cari Katering
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.orders.*') ? 'active' : '' }}"
                       href="{{ route('customer.orders.index') }}"
                       @if (request()->routeIs('customer.orders.*')) aria-current="page" @endif>
                        <i class="bi bi-bag-check me-2"></i>
                        Pesanan Saya
                    </a>
                </li>
            </ul>

            {{-- Dropdown Akun --}}
            <div class="customer-account ms-lg-auto">
                <div class="dropdown">
                    <button class="customer-account-toggle dropdown-toggle"
                            type="button"
                            id="customerAccountDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <span class="customer-account-avatar">
                            <i class="bi bi-person"></i>
                        </span>

                        <span class="customer-account-info">
                            <span class="customer-account-name">
                                {{ auth()->user()->customer?->nama_perusahaan
                                    ?? auth()->user()->nama
                                    ?? auth()->user()->email }}
                            </span>
                            <span class="customer-account-role">Customer</span>
                        </span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end customer-account-menu"
                        aria-labelledby="customerAccountDropdown">

                        <li>
                            <div class="customer-dropdown-heading">
                                <span class="customer-dropdown-label">
                                    AKUN SAYA
                                </span>
                                <div class="customer-dropdown-name">
                                    {{ auth()->user()->customer?->nama_perusahaan
                                        ?? auth()->user()->nama
                                        ?? auth()->user()->email }}
                                </div>
                            </div>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item customer-dropdown-item {{ request()->routeIs('customer.profile.*') ? 'active' : '' }}"
                               href="{{ route('customer.profile.index') }}">
                                <i class="bi bi-building"></i>
                                <span>Profil Usaha</span>
                                <i class="bi bi-chevron-right ms-auto"></i>
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <button type="button"
                                    class="dropdown-item customer-dropdown-item customer-logout-trigger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#customerLogoutModal">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- Modal Logout: di luar navbar --}}
<div class="modal fade" id="customerLogoutModal" tabindex="-1"
     aria-labelledby="customerLogoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content customer-logout-modal">
            <div class="modal-body p-4 p-md-5 text-center">

                <div class="customer-logout-icon mb-4">
                    <i class="bi bi-box-arrow-right"></i>
                </div>

                <h5 class="customer-logout-title mb-2"
                    id="customerLogoutModalLabel">
                    Keluar dari akun?
                </h5>

                <p class="customer-logout-description mb-4">
                    Apakah kamu yakin ingin keluar dari akun Customer?
                    Kamu perlu login kembali untuk melakukan pemesanan.
                </p>

                <div class="d-flex justify-content-center gap-2">
                    <button type="button"
                            class="btn customer-logout-cancel"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn customer-logout-confirm">
                            Ya, Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
