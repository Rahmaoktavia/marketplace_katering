@extends('customer.layouts.main')

@section('title', 'Checkout')

@section('content')

    {{-- Header Halaman --}}
    <section class="mb-4">

        <div>
            <span class="small fw-semibold"
                  style="color: #2769a8; letter-spacing: 1.5px;">
                LANGKAH PEMESANAN
            </span>

            <h1 class="h2 fw-bold mt-2 mb-2"
                style="color: #243047;">
                Checkout Pesanan
            </h1>

            <p class="text-secondary mb-0"
               style="line-height: 1.8;">
                Periksa menu pilihanmu, lalu lengkapi informasi pesanan
                dan pengiriman dengan benar.
            </p>
        </div>
    </section>


    {{-- Konten Checkout --}}
    <div class="row g-4 align-items-start">

        {{-- Kolom Kiri: Ringkasan Menu --}}
        <div class="col-lg-5">

            <div class="card rounded-4 overflow-hidden shadow-sm"
                 style="border: 1px solid #e3eaf2;">

                {{-- Foto Menu --}}
                <div class="position-relative">

                    @if ($menu->foto)
                        <img
                            src="{{ asset('storage/' . $menu->foto) }}"
                            alt="{{ $menu->nama_menu }}"
                            class="card-img-top"
                            style="height: 250px; object-fit: cover;"
                        >
                    @else
                        <div class="d-flex align-items-center justify-content-center"
                             style="height: 250px;
                                    background: linear-gradient(135deg, #e8f3ff, #f7faff);">

                            <div class="text-center">
                                <i class="bi bi-egg-fried d-block mb-2"
                                   style="font-size: 60px; color: #8bb5df;"></i>

                                <span class="small"
                                      style="color: #687386;">
                                    Foto menu belum tersedia
                                </span>
                            </div>
                        </div>
                    @endif

                    {{-- Badge Kategori --}}
                    <span class="badge rounded-pill position-absolute top-0 start-0 m-3 px-3 py-2 shadow-sm"
                          style="background: rgba(255, 255, 255, .96);
                                 color: #2769a8;
                                 font-size: 12px;">

                        <i class="bi bi-tag me-1"></i>
                        {{ $menu->category?->nama_kategori ?? 'Menu Katering' }}

                    </span>

                </div>


                {{-- Detail Menu --}}
                <div class="card-body p-4">

                    <h2 class="h4 fw-bold mt-2 mb-2"
                        style="color: #243047; line-height: 1.5;">
                        {{ $menu->nama_menu }}
                    </h2>

                    {{-- Deskripsi Menu --}}
                    <p class="text-secondary small mb-4"
                       style="line-height: 1.8;">
                        {{ $menu->deskripsi ?: 'Tidak ada deskripsi tambahan untuk menu ini.' }}
                    </p>


                    {{-- Informasi Penyedia --}}
                    <div class="rounded-3 p-3 mb-4"
                         style="background: #f8fbff;
                                border: 1px solid #dce9f8;">

                        {{-- Nama Usaha --}}
                        <div class="d-flex align-items-center gap-2 mb-2">

                            <i class="bi bi-shop flex-shrink-0"
                               style="width: 18px;
                                      font-size: 15px;
                                      color: #2769a8;"></i>

                            <span class="fw-semibold text-break"
                                  style="color: #243047; font-size: 14px;">
                                {{ $menu->merchant?->nama_perusahaan ?? 'Usaha Katering' }}
                            </span>

                        </div>

                        {{-- Kota Usaha --}}
                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-geo-alt flex-shrink-0"
                               style="width: 18px;
                                      font-size: 15px;
                                      color: #2769a8;"></i>

                            <span class="small text-secondary">
                                {{ $menu->merchant?->kota ?: 'Kota belum diisi' }}
                            </span>

                        </div>

                    </div>


                    {{-- Harga Menu --}}
                    <div class="pt-3"
                         style="border-top: 1px solid #e8edf4;">

                        <span class="small text-secondary d-block mb-1">
                            Harga per porsi
                        </span>

                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

                            <span class="fw-bold fs-4"
                                  style="color: #2769a8;">
                                Rp{{ number_format((float) $menu->harga, 0, ',', '.') }}
                            </span>

                            <span class="d-inline-flex align-items-center gap-1 rounded-pill px-3 py-2"
                                  style="background: linear-gradient(135deg, #f0fdf4 0%, #e3f6e9 100%);
                                         border: 1px solid #d2ecd9;
                                         color: #23834d;
                                         font-size: 12px;
                                         font-weight: 500;">

                                <i class="bi bi-check-circle-fill"></i>
                                Tersedia

                            </span>

                        </div>
                    </div>

                </div>
            </div>


            {{-- Informasi Bantuan --}}
            <div class="d-flex align-items-start gap-3 rounded-4 p-3 mt-3"
                 style="background: #eef6ff;
                        border: 1px solid #dce9f8;">

                <i class="bi bi-info-circle flex-shrink-0 mt-1"
                   style="font-size: 18px; color: #2769a8;"></i>

                <p class="small mb-0"
                   style="color: #42556d; line-height: 1.8;">
                    Pastikan jumlah porsi, tanggal, dan alamat pengiriman
                    sudah benar sebelum membuat pesanan.
                </p>

            </div>

        </div>


        {{-- Kolom Kanan: Form Checkout --}}
        <div class="col-lg-7">

            <div class="card rounded-4 shadow-sm"
                 style="border: 1px solid #e3eaf2;">

                <div class="card-body p-4 p-md-5">

                    {{-- Judul Form --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">

                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                 style="width: 48px;
                                        height: 48px;
                                        background: #e8f3ff;">

                                <i class="bi bi-clipboard-check"
                                   style="font-size: 24px; color: #2769a8;"></i>

                            </div>

                            <div>
                                <h2 class="h5 fw-bold mb-1"
                                    style="color: #243047;">
                                    Informasi Pesanan
                                </h2>

                                <p class="small text-secondary mb-0">
                                    Lengkapi detail pemesananmu.
                                </p>
                            </div>

                        </div>
                    </div>


                    <form action="{{ route('customer.checkout.store', ['menu' => $menu->id]) }}"
                          method="POST">

                        @csrf


                        {{-- Jumlah Porsi --}}
                        <div class="mb-4">

                            <label for="jumlah_porsi"
                                   class="form-label fw-semibold small">
                                Jumlah Porsi
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-white"
                                      style="color: #2769a8;">
                                    <i class="bi bi-hash"></i>
                                </span>

                                <input
                                    type="number"
                                    id="jumlah_porsi"
                                    name="jumlah_porsi"
                                    class="form-control @error('jumlah_porsi') is-invalid @enderror"
                                    min="1"
                                    max="10000"
                                    value="{{ old('jumlah_porsi', 1) }}"
                                    placeholder="Masukkan jumlah porsi"
                                    required
                                >

                                @error('jumlah_porsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-text">
                                Masukkan jumlah porsi yang ingin dipesan.
                            </div>

                        </div>


                        {{-- Tanggal Pengiriman --}}
                        <div class="mb-4">

                            <label for="tanggal_pengiriman"
                                   class="form-label fw-semibold small">
                                Tanggal Pengiriman
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-white"
                                      style="color: #2769a8;">
                                    <i class="bi bi-calendar-event"></i>
                                </span>

                                <input
                                    type="date"
                                    id="tanggal_pengiriman"
                                    name="tanggal_pengiriman"
                                    class="form-control @error('tanggal_pengiriman') is-invalid @enderror"
                                    min="{{ now()->toDateString() }}"
                                    value="{{ old('tanggal_pengiriman') }}"
                                    required
                                >

                                @error('tanggal_pengiriman')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-text">
                                Pilih tanggal saat pesanan ingin diterima.
                            </div>

                        </div>


                        {{-- Alamat Pengiriman --}}
                        <div class="mb-4">

                            <label for="alamat_pengiriman"
                                   class="form-label fw-semibold small">
                                Alamat Pengiriman
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                id="alamat_pengiriman"
                                name="alamat_pengiriman"
                                rows="3"
                                class="form-control @error('alamat_pengiriman') is-invalid @enderror"
                                placeholder="Masukkan alamat lengkap penerima"
                                required
                            >{{ old('alamat_pengiriman', auth()->user()->customer?->alamat ?? '') }}</textarea>

                            @error('alamat_pengiriman')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-text">
                                Pastikan alamat lengkap dan mudah ditemukan.
                            </div>

                        </div>


                        {{-- Catatan --}}
                        <div class="mb-4">

                            <label for="catatan"
                                   class="form-label fw-semibold small">
                                Catatan Tambahan
                                <span class="text-secondary fw-normal">
                                    (Opsional)
                                </span>
                            </label>

                            <textarea
                                id="catatan"
                                name="catatan"
                                rows="3"
                                class="form-control @error('catatan') is-invalid @enderror"
                                placeholder="Contoh: makanan tidak terlalu pedas..."
                            >{{ old('catatan') }}</textarea>

                            @error('catatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Informasi Perhitungan Harga --}}
                        <div class="rounded-3 p-3 mb-4"
                             style="background: #f8fbff;
                                    border: 1px solid #dce9f8;">

                            <div class="d-flex align-items-start gap-2">

                                <i class="bi bi-shield-check mt-1"
                                   style="font-size: 18px; color: #2769a8;"></i>

                                <div>
                                    <p class="small fw-semibold mb-1"
                                       style="color: #243047;">
                                        Perhitungan Total Pesanan
                                    </p>

                                    <p class="small text-secondary mb-0"
                                       style="line-height: 1.8;">
                                        Total pesanan dihitung berdasarkan harga
                                        menu dan jumlah porsi yang dipesan.
                                        Pastikan jumlah porsi sudah sesuai sebelum
                                        melanjutkan.
                                    </p>
                                </div>

                            </div>

                        </div>


                        {{-- Tombol Aksi --}}
                        <div class="d-grid gap-2">

                            <button type="submit"
                                    class="btn rounded-3 py-3 fw-semibold"
                                    style="background: #2769a8; color: #ffffff;">

                                <i class="bi bi-bag-check me-2"></i>
                                Buat Pesanan

                            </button>

                            <a href="{{ route('customer.caterings.index') }}"
                               class="btn rounded-3 py-2"
                               style="color: #2769a8; background: #ffffff; border: 1px solid #dce9f8;">

                                Kembali Memilih Menu

                            </a>

                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

@endsection
