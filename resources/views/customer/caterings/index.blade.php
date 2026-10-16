@extends('customer.layouts.main')

@section('title', 'Cari Katering')

@section('content')

    {{-- Header Halaman --}}
    <section class="mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>
                <span class="small fw-semibold"
                      style="color: #2769a8; letter-spacing: 1.5px;">
                    JELAJAHI PILIHAN
                </span>

                <h1 class="h2 fw-bold mt-2 mb-2"
                    style="color: #243047;">
                    Temukan Menu Favoritmu
                </h1>

                <p class="text-secondary mb-0"
                   style="line-height: 1.8;">
                    Pilih hidangan favorit dari berbagai usaha katering
                    sesuai kebutuhanmu.
                </p>
            </div>

            <div class="d-none d-md-flex align-items-center justify-content-center rounded-circle"
                 style="width: 76px; height: 76px; background: #e8f3ff;">
                <i class="bi bi-basket2"
                   style="font-size: 36px; color: #2769a8;"></i>
            </div>

        </div>
    </section>


    {{-- Form Pencarian --}}
    <section class="mb-5">
        <div class="rounded-4 p-3 p-md-4"
             style="background: linear-gradient(135deg, #eef6ff 0%, #ffffff 100%);
                    border: 1px solid #dce8f5;">

            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-sliders"
                   style="font-size: 20px; color: #2769a8;"></i>

                <h2 class="h6 fw-bold mb-0" style="color: #243047;">
                    Cari Menu Katering
                </h2>
            </div>

            <form action="{{ route('customer.caterings.index') }}"
                  method="GET">

                <div class="row g-3">

                    {{-- Kata Kunci --}}
                    <div class="col-lg-5">
                        <label for="q"
                               class="form-label small fw-semibold">
                            Nama menu atau usaha
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-white"
                                  style="border-right: 0; color: #2769a8;">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="q"
                                id="q"
                                class="form-control"
                                style="border-left: 0;"
                                value="{{ request('q') }}"
                                placeholder="Contoh: nasi rendang"
                            >
                        </div>
                    </div>

                    {{-- Filter Kota --}}
                    <div class="col-sm-6 col-lg-2">
                        <label for="kota"
                               class="form-label small fw-semibold">
                            Kota
                        </label>

                        <select name="kota"
                                id="kota"
                                class="form-select">

                            <option value="">Semua kota</option>

                            @foreach ($cities as $city)
                                <option value="{{ $city }}"
                                    @selected(request('kota') === $city)>
                                    {{ $city }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Filter Kategori --}}
                    <div class="col-sm-6 col-lg-3">
                        <label for="kategori"
                               class="form-label small fw-semibold">
                            Kategori menu
                        </label>

                        <select name="kategori"
                                id="kategori"
                                class="form-select">

                            <option value="">Semua kategori</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected((string) request('kategori') === (string) $category->id)>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Tombol Pencarian --}}
                    <div class="col-lg-2 d-flex align-items-end">
                        <button type="submit"
                                class="btn w-100 rounded-3 py-2 fw-semibold"
                                style="background: #2769a8; color: #ffffff;">
                            <i class="bi bi-search me-1"></i>
                            Cari Menu
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </section>


    {{-- Heading Hasil Pencarian --}}
    <section class="mb-4">

        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">

            <div>
                <span class="small fw-semibold"
                      style="color: #2769a8;">
                    PILIHAN KATERING
                </span>

                <h2 class="h4 fw-bold mt-2 mb-1"
                    style="color: #243047;">
                    Menu Tersedia
                </h2>

                <p class="text-secondary small mb-0">
                    Temukan hidangan yang sesuai dengan seleramu.
                </p>
            </div>

            <div class="text-end">
                <span class="badge rounded-pill px-3 py-2"
                      style="background: #e8f3ff; color: #2769a8;">
                    <i class="bi bi-grid me-1"></i>
                    {{ $menus->total() }} menu ditemukan
                </span>
            </div>

        </div>

    </section>


    {{-- Katalog Menu --}}
    <section class="mb-4">
        <div class="row g-4">

            @forelse ($menus as $menu)
                <div class="col-sm-6 col-xl-4">

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

                            {{-- Harga dan Tombol --}}
                            <div class="mt-auto pt-3"
                                 style="border-top: 1px solid #e8edf4;">

                                <div class="d-flex justify-content-between align-items-end gap-2 mb-3">

                                    <div>
                                        <span class="small text-secondary d-block mb-1">
                                            Harga per porsi
                                        </span>

                                        <span class="fw-bold fs-5"
                                              style="color: #2769a8;">
                                            Rp{{ number_format((float) $menu->harga, 0, ',', '.') }}
                                        </span>
                                    </div>

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

                                </div>

                                {{-- Pesan Menu --}}
                                <a href="{{ route('customer.checkout.create', ['menu' => $menu->id]) }}"
                                   class="btn w-100 rounded-3 py-2 fw-semibold"
                                   style="background: #2769a8; color: #ffffff;">

                                    <i class="bi bi-basket2 me-2"></i>
                                    Pesan Menu

                                </a>

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

                            <i class="bi bi-search"
                               style="font-size: 36px; color: #2769a8;"></i>

                        </div>

                        <h3 class="h5 fw-bold mb-2"
                            style="color: #243047;">
                            Menu Belum Ditemukan
                        </h3>

                        <p class="text-secondary small mb-4"
                           style="line-height: 1.8;">
                            Belum ada menu yang sesuai dengan pencarianmu.
                            Coba gunakan kata kunci, kota, atau kategori lain.
                        </p>

                        <a href="{{ route('customer.caterings.index') }}"
                           class="btn rounded-3 px-4"
                           style="background: #2769a8; color: #ffffff;">

                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                            Reset Pencarian

                        </a>

                    </div>

                </div>

            @endforelse

        </div>
    </section>


    {{-- Pagination --}}
    @if ($menus->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $menus->appends(request()->query())->links() }}
        </div>
    @endif

@endsection