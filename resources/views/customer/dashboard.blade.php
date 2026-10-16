
@extends('customer.layouts.main')

@section('title', 'Beranda Customer')

@section('content')
    @php
        $namaCustomer = auth()->user()->customer?->nama_perusahaan
            ?? auth()->user()->nama
            ?? 'Customer';

        $categoryIcons = [
            'bi-egg-fried',
            'bi-cup-hot',
            'bi-basket2',
            'bi-cake2',
            'bi-egg',
            'bi-grid',
        ];
    @endphp

    <section class="rounded-4 p-4 p-md-5 mb-5"
             style="background: linear-gradient(120deg, #e8f3ff, #ffffff); border: 1px solid var(--border);">

        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="badge rounded-pill mb-3"
                      style="background: #d4e8ff; color: var(--primary-dark);">
                    <i class="bi bi-shop me-1"></i>
                    MARKETPLACE KATERING
                </span>

                <p class="text-secondary small mb-2">
                    Selamat datang, {{ $namaCustomer }}!
                </p>

                <h1 class="display-6 fw-bold mb-3"
                    style="font-family: 'Poppins', sans-serif; color: #243047;">
                    Temukan Katering yang Sesuai Kebutuhanmu
                </h1>

                <p class="text-secondary mb-4" style="line-height: 1.9;">
                    Temukan pilihan menu katering, bandingkan informasi
                    yang tersedia, dan pilih hidangan sesuai kebutuhanmu.
                </p>
            </div>

            <div class="col-lg-4 text-center">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                     style="width: 180px; height: 180px; background: rgba(255,255,255,.8); border: 1px solid #dce9f8;">
                    <i class="bi bi-basket2"
                       style="font-size: 90px; color: var(--primary);"></i>
                </div>
            </div>
        </div>
    </section>

<section class="mb-5" id="pilihan-menu">

    {{-- Heading --}}
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
        <div>
            <span class="small fw-semibold"
                  style="color: #2769a8; letter-spacing: 1px;">
                PILIHAN UNTUKMU
            </span>

            <h2 class="h3 fw-bold mt-2 mb-2">
                Pilihan Menu Katering
            </h2>

            <p class="text-secondary small mb-0">
                Temukan hidangan favoritmu dari berbagai penyedia katering.
            </p>
        </div>

        <a href="{{ route('customer.caterings.index') }}"
           class="text-decoration-none fw-semibold small"
           style="color: #2769a8;">
            Lihat semua menu
            <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>


    {{-- Daftar Menu --}}
    <div class="row g-4">

        @forelse ($menus as $menu)
            <div class="col-sm-6 col-lg-4">

                <div class="card h-100 rounded-4 overflow-hidden shadow-sm"
                     style="border: 1px solid #e3eaf2;">

                    {{-- Foto Menu --}}
                    <div class="position-relative">

                        @if ($menu->foto)
                            <img
                                src="{{ asset('storage/' . $menu->foto) }}"
                                alt="{{ $menu->nama_menu }}"
                                class="card-img-top"
                                style="height: 225px; object-fit: cover;"
                                loading="lazy"
                            >
                        @else
                            <div class="d-flex align-items-center justify-content-center"
                                 style="height: 225px;
                                        background: linear-gradient(135deg, #e8f3ff, #f7faff);">

                                <div class="text-center">
                                    <i class="bi bi-egg-fried d-block mb-2"
                                       style="font-size: 55px; color: #8bb5df;"></i>

                                    <span class="small"
                                          style="color: #687386;">
                                        Foto menu belum tersedia
                                    </span>
                                </div>
                            </div>
                        @endif

                        {{-- Badge Kategori --}}
                        <span class="badge rounded-pill position-absolute top-0 start-0 m-3 px-3 py-2 shadow-sm"
                              style="background: rgba(255, 255, 255, 0.96);
                                     color: #2769a8;
                                     font-size: 12px;">

                            <i class="bi bi-tag me-1"></i>
                            {{ $menu->category?->nama_kategori ?? 'Menu Katering' }}

                        </span>

                    </div>


                    {{-- Informasi Menu --}}
                    <div class="card-body d-flex flex-column p-4">

                        {{-- Nama Menu --}}
                        <h3 class="h5 fw-bold mb-3"
                            style="color: #243047; line-height: 1.5;">
                            {{ $menu->nama_menu }}
                        </h3>


                        {{-- Informasi Penyedia Katering --}}
                        <div class="rounded-3 p-3 mb-3"
                             style="background: #f8fbff; border: 1px solid #dce9f8;">

                            {{-- Nama Usaha --}}
                            <div class="d-flex align-items-center gap-2 mb-2">

                                <i class="bi bi-shop flex-shrink-0"
                                   style="width: 18px; font-size: 15px; color: #2769a8;"></i>

                                <span class="fw-semibold text-truncate"
                                      style="color: #243047; font-size: 14px;"
                                      title="{{ $menu->merchant?->nama_perusahaan ?? 'Usaha Katering' }}">

                                    {{ $menu->merchant?->nama_perusahaan ?? 'Usaha Katering' }}

                                </span>

                            </div>

                            {{-- Kota Usaha --}}
                            <div class="d-flex align-items-center gap-2">

                                <i class="bi bi-geo-alt flex-shrink-0"
                                   style="width: 18px; font-size: 15px; color: #2769a8;"></i>

                                <span class="small text-secondary text-truncate">

                                    {{ $menu->merchant?->kota ?: 'Kota belum diisi' }}

                                </span>

                            </div>

                        </div>


                        {{-- Harga dan Status --}}
                        <div class="mt-auto pt-3"
                             style="border-top: 1px solid #e8edf4;">

                            <div class="d-flex justify-content-between align-items-end gap-2 mb-3">

                                {{-- Harga --}}
                                <div>
                                    <span class="small text-secondary d-block mb-1">
                                        Harga per porsi
                                    </span>

                                    <span class="fw-bold fs-5"
                                          style="color: #2769a8;">

                                        Rp{{ number_format((float) $menu->harga, 0, ',', '.') }}

                                    </span>
                                </div>

                                {{-- Status Ketersediaan --}}
                                @if ($menu->tersedia)
                                    <span class="d-inline-flex align-items-center gap-1 rounded-pill px-3 py-2"
                                          style="background: linear-gradient(135deg, #f0fdf4 0%, #e3f6e9 100%);
                                                 border: 1px solid #d2ecd9;
                                                 color: #23834d;
                                                 font-size: 12px;
                                                 font-weight: 500;
                                                 white-space: nowrap;">

                                        <i class="bi bi-check-circle-fill"
                                           style="font-size: 12px;"></i>

                                        Tersedia
                                    </span>
                                @else
                                    <span class="d-inline-flex align-items-center gap-1 rounded-pill px-3 py-2"
                                          style="background: #f3f4f6;
                                                 border: 1px solid #e5e7eb;
                                                 color: #6b7280;
                                                 font-size: 12px;
                                                 white-space: nowrap;">

                                        <i class="bi bi-x-circle-fill"
                                           style="font-size: 12px;"></i>

                                        Tidak tersedia
                                    </span>
                                @endif

                            </div>


                            {{-- Tombol Pesan --}}
                            @if ($menu->tersedia)
                                <a href="{{ route('customer.checkout.create', ['menu' => $menu->id]) }}"
                                   class="btn w-100 rounded-3 py-2 fw-semibold"
                                   style="background: #2769a8; color: #ffffff;">

                                    <i class="bi bi-basket2 me-2"></i>
                                    Pesan Menu

                                </a>
                            @else
                                <button type="button"
                                        class="btn w-100 rounded-3 py-2 fw-semibold"
                                        style="background: #f3f4f6;
                                               color: #9ca3af;
                                               border: 1px solid #e5e7eb;"
                                        disabled>

                                    <i class="bi bi-basket2 me-2"></i>
                                    Menu Tidak Tersedia

                                </button>
                            @endif

                        </div>

                    </div>
                </div>

            </div>

        @empty

            {{-- Kondisi Tidak Ada Menu --}}
            <div class="col-12">
                <div class="bg-white rounded-4 border text-center p-4 p-md-5">

                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                         style="width: 82px; height: 82px; background: #e8f3ff;">

                        <i class="bi bi-basket2"
                           style="font-size: 36px; color: #2769a8;"></i>

                    </div>

                    <h3 class="h5 fw-bold mb-2"
                        style="color: #243047;">
                        Belum Ada Menu Katering
                    </h3>

                    <p class="text-secondary small mb-4"
                       style="line-height: 1.8;">
                        Pilihan menu akan muncul setelah penyedia katering
                        menambahkan menu yang tersedia.
                    </p>

                    <a href="{{ route('customer.caterings.index') }}"
                       class="btn rounded-3 px-4"
                       style="background: #2769a8; color: #ffffff;">

                        <i class="bi bi-search me-1"></i>
                        Jelajahi Katering

                    </a>

                </div>
            </div>

        @endforelse

    </div>
</section>

    <section class="mb-4">
        <div class="rounded-4 p-4 p-md-5"
            style="background: linear-gradient(135deg, #1f568b 0%, #2769a8 55%, #5795cf 100%);
                    border: 1px solid rgba(255, 255, 255, 0.25);">

            {{-- Heading --}}
            <div class="text-center mb-4">
                <span class="small fw-semibold"
                    style="color: #d7eaff; letter-spacing: 1.5px;">
                    THE MARKETPLACE EXPERIENCE
                </span>

                <h2 class="h3 fw-bold mt-2 mb-2 text-white">
                    Kenapa Memilih Marketplace Katering?
                </h2>

                <p class="small mb-0"
                style="color: #e5f1ff; line-height: 1.8;">
                    Pengalaman mencari dan mengelola pesanan dalam satu platform.
                </p>
            </div>

            {{-- Kelebihan Marketplace --}}
            <div class="row g-4">

                {{-- Kelebihan 1 --}}
                <div class="col-md-4">
                    <div class="h-100 bg-white rounded-4 p-4"
                        style="border: 1px solid rgba(255,255,255,.7);
                                box-shadow: 0 8px 24px rgba(17, 51, 84, .12);">

                        <div class="d-flex align-items-center justify-content-center rounded-3 mb-3"
                            style="width: 50px; height: 50px;
                                    background: #e8f3ff; color: #2769a8;">
                            <i class="bi bi-search fs-4"></i>
                        </div>

                        <h3 class="h6 fw-bold mb-2" style="color: #243047;">
                            Mudah Menemukan Katering
                        </h3>

                        <p class="text-secondary small mb-0" style="line-height: 1.9;">
                            Jelajahi informasi usaha katering melalui satu marketplace.
                        </p>
                    </div>
                </div>

                {{-- Kelebihan 2 --}}
                <div class="col-md-4">
                    <div class="h-100 bg-white rounded-4 p-4"
                        style="border: 1px solid rgba(255,255,255,.7);
                                box-shadow: 0 8px 24px rgba(17, 51, 84, .12);">

                        <div class="d-flex align-items-center justify-content-center rounded-3 mb-3"
                            style="width: 50px; height: 50px;
                                    background: #e8f7ee; color: #23834d;">
                            <i class="bi bi-card-checklist fs-4"></i>
                        </div>

                        <h3 class="h6 fw-bold mb-2" style="color: #243047;">
                            Informasi Menu Lebih Jelas
                        </h3>

                        <p class="text-secondary small mb-0" style="line-height: 1.9;">
                            Periksa kategori, deskripsi, harga, dan ketersediaan
                            sebelum memilih menu.
                        </p>
                    </div>
                </div>

                {{-- Kelebihan 3 --}}
                <div class="col-md-4">
                    <div class="h-100 bg-white rounded-4 p-4"
                        style="border: 1px solid rgba(255,255,255,.7);
                                box-shadow: 0 8px 24px rgba(17, 51, 84, .12);">

                        <div class="d-flex align-items-center justify-content-center rounded-3 mb-3"
                            style="width: 50px; height: 50px;
                                    background: #fff1df; color: #bd7622;">
                            <i class="bi bi-receipt fs-4"></i>
                        </div>

                        <h3 class="h6 fw-bold mb-2" style="color: #243047;">
                            Pesanan Lebih Terorganisasi
                        </h3>

                        <p class="text-secondary small mb-0" style="line-height: 1.9;">
                            Akses halaman pesanan untuk memeriksa informasi
                            dan status pemesananmu.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
