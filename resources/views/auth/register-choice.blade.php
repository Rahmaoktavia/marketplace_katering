@extends('layouts.auth')

@section('title', 'Buat Akun')

@section('content')
    <div class="register-header">
        <div class="brand-icon">
            <i class="bi bi-shop" aria-hidden="true"></i>
        </div>

        <p class="brand-name">Marketplace Katering</p>

        <p class="subtitle">
            Pilih jenis akun untuk mulai menggunakan
            Marketplace Katering.
        </p>
    </div>

    <div class="account-options">
        <a href="{{ route('register.customer') }}" class="account-card">
            <div class="account-icon customer-icon">
                <i class="bi bi-bag-check" aria-hidden="true"></i>
            </div>

            <div class="account-info">
                <h2>Customer</h2>

                <p>
                    Temukan katering sesuai kebutuhan dan
                    pesan makanan dengan mudah.
                </p>

                <span class="account-link">
                    Daftar sebagai Customer
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </span>
            </div>
        </a>

        <a href="{{ route('register.merchant') }}" class="account-card">
            <div class="account-icon merchant-icon">
                <i class="bi bi-shop-window" aria-hidden="true"></i>
            </div>

            <div class="account-info">
                <h2>Merchant</h2>

                <p>
                    Daftarkan usaha katering, kelola menu,
                    dan terima pesanan pelanggan.
                </p>

                <span class="account-link">
                    Daftar sebagai Merchant
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </span>
            </div>
        </a>
    </div>

    <div class="register-footer">
        <p>
            Sudah punya akun?
            <a href="{{ route('login') }}" class="link">
                Masuk sekarang
            </a>
        </p>
    </div>
@endsection
