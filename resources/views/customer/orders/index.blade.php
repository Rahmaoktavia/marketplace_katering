@extends('customer.layouts.main')

@section('title', 'Pesanan Saya')

@section('content')
    @php
        $orderStatusLabels = [
            'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
            'dikonfirmasi' => 'Dikonfirmasi',
            'diproses' => 'Sedang Diproses',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];

        $orderStatusClasses = [
            'menunggu_konfirmasi' => 'order-status-pending',
            'dikonfirmasi' => 'order-status-confirmed',
            'diproses' => 'order-status-processing',
            'selesai' => 'order-status-complete',
            'dibatalkan' => 'order-status-cancelled',
        ];

        $paymentStatusLabels = [
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'berhasil' => 'Berhasil',
            'gagal' => 'Gagal',
            'kedaluwarsa' => 'Kedaluwarsa',
        ];

        $paymentStatusClasses = [
            'menunggu_pembayaran' => 'order-payment-pending',
            'berhasil' => 'order-payment-success',
            'gagal' => 'order-payment-failed',
            'kedaluwarsa' => 'order-payment-expired',
        ];
    @endphp

    <div class="customer-orders-page">

        {{-- Header --}}
        <section class="customer-orders-hero mb-4">
            <div class="d-flex align-items-center justify-content-between gap-3">

                <div>
                    <span class="customer-orders-eyebrow">
                        RIWAYAT PEMESANAN
                    </span>

                    <h1 class="h2 fw-bold mt-2 mb-2"
                        style="color: #243047;">
                        Pesanan Saya
                    </h1>

                    <p class="text-secondary small mb-0"
                       style="line-height: 1.8;">
                        Pantau status pesanan, jadwal pengiriman,
                        pembayaran, dan invoice kamu di sini.
                    </p>
                </div>

                <div class="customer-orders-hero-icon d-none d-sm-flex">
                    <i class="bi bi-bag-check"></i>
                </div>

            </div>

            <div class="mt-4">
                <a href="{{ route('customer.caterings.index') }}"
                   class="customer-orders-primary-link">
                    <i class="bi bi-search"></i>
                    Cari Katering
                </a>
            </div>
        </section>


        {{-- Judul Daftar Pesanan --}}
        <div class="customer-orders-toolbar">

            <div>
                <h2 class="h5 fw-bold mb-1"
                    style="color: #243047;">
                    Riwayat Pesanan
                </h2>

                <p class="small text-secondary mb-0">
                    Semua pesanan yang kamu buat tercatat di sini.
                </p>
            </div>

            <span class="customer-orders-count">
                <i class="bi bi-receipt"></i>
                {{ number_format($orders->total(), 0, ',', '.') }}
                {{ $orders->total() === 1 ? 'pesanan' : 'pesanan' }}
            </span>

        </div>


        {{-- Daftar Kartu Pesanan --}}
        <div class="customer-order-list">

            @forelse ($orders as $order)
                @php
                    $orderStatus = $order->status_pesanan;
                    $paymentStatus = $order->payment?->status_pembayaran;
                @endphp

                <article class="customer-order-card">

                    {{-- Bagian Atas: Nomor dan Status --}}
                    <div class="customer-order-card-header">

                        <div class="customer-order-identity">

                            <div class="customer-order-icon">
                                <i class="bi bi-receipt-cutoff"></i>
                            </div>

                            <div class="min-w-0">

                                <span class="customer-order-overline">
                                    Nomor Pesanan
                                </span>

                                <h3 class="customer-order-number">
                                    {{ $order->nomor_pesanan }}
                                </h3>

                                <div class="customer-order-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    Dipesan pada
                                    {{ $order->created_at?->format('d M Y, H:i') ?? '-' }}
                                </div>

                            </div>

                        </div>

                        <span class="customer-order-status {{ $orderStatusClasses[$orderStatus] ?? 'order-status-default' }}">
                            <i class="bi bi-circle-fill"
                               style="font-size: 6px;"></i>

                            {{ $orderStatusLabels[$orderStatus] ?? ucfirst(str_replace('_', ' ', $orderStatus)) }}
                        </span>

                    </div>


                    <div class="customer-order-divider"></div>

                    {{-- Foto Menu, Merchant, dan Pengiriman --}}
                    <div class="customer-order-card-body">

                        {{-- Preview Menu yang Dipesan --}}
                        <div class="customer-order-menu-preview mb-4">

                            @forelse ($order->items->take(3) as $item)
                                <div class="customer-order-menu-item">

                                    {{-- Foto Menu --}}
                                    @if ($item->menu?->foto)
                                        <img
                                            src="{{ asset('storage/' . $item->menu->foto) }}"
                                            alt="{{ $item->nama_menu }}"
                                            class="customer-order-menu-photo"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="customer-order-menu-photo customer-order-menu-placeholder">
                                            <i class="bi bi-egg-fried"></i>
                                        </div>
                                    @endif

                                    {{-- Nama Menu dan Porsi --}}
                                    <div class="customer-order-menu-details">

                                        <div class="customer-order-menu-name">
                                            {{ $item->nama_menu }}
                                        </div>

                                        <div class="customer-order-menu-meta">
                                            {{ number_format($item->jumlah_porsi, 0, ',', '.') }} porsi
                                            <span class="mx-1">·</span>
                                            Rp{{ number_format((float) $item->harga_satuan, 0, ',', '.') }}/porsi
                                        </div>

                                    </div>

                                </div>
                            @empty
                                <p class="small text-secondary mb-0">
                                    Belum ada rincian menu.
                                </p>
                            @endforelse

                            {{-- Jika pesanan berisi lebih dari 3 item --}}
                            @if ($order->items->count() > 3)
                                <div class="customer-order-menu-more">
                                    + {{ $order->items->count() - 3 }} menu lainnya
                                </div>
                            @endif

                        </div>

                        <div class="customer-order-divider mb-3"
                            style="margin-right: 0; margin-left: 0;"></div>

                        {{-- Informasi Merchant dan Pengiriman --}}
                        <div class="customer-order-info-grid">

                            <div>
                                <div class="customer-order-info-label">
                                    <i class="bi bi-shop"></i>
                                    Penyedia Katering
                                </div>

                                <div class="customer-order-merchant">
                                    {{ $order->merchant?->nama_perusahaan ?? '-' }}
                                </div>
                            </div>

                            <div>
                                <div class="customer-order-info-label">
                                    <i class="bi bi-truck"></i>
                                    Tanggal Pengiriman
                                </div>

                                <div class="customer-order-info-value">
                                    {{ $order->tanggal_pengiriman?->format('d M Y') ?? '-' }}
                                </div>
                            </div>

                        </div>

                    </div>


                    {{-- Bagian Bawah: Pembayaran dan Aksi --}}
                    <div class="customer-order-card-footer">

                        <div class="customer-order-payment">

                            <span class="customer-order-payment-label">
                                Status Pembayaran
                            </span>

                            <span class="customer-payment-status {{ $paymentStatusClasses[$paymentStatus] ?? 'order-payment-default' }}">

                                @if ($paymentStatus === 'berhasil')
                                    <i class="bi bi-check-circle-fill"></i>
                                @elseif (in_array($paymentStatus, ['gagal', 'kedaluwarsa'], true))
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                @elseif ($paymentStatus === 'menunggu_pembayaran')
                                    <i class="bi bi-clock-fill"></i>
                                @else
                                    <i class="bi bi-dash-circle"></i>
                                @endif

                                {{ $paymentStatusLabels[$paymentStatus] ?? 'Belum tersedia' }}

                            </span>

                        </div>


                        <div class="customer-order-total">
                            <span class="customer-order-total-label">
                                Total Pembayaran
                            </span>

                            <span class="customer-order-total-value">
                                Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}
                            </span>
                        </div>


                        <a href="{{ route('customer.orders.show', $order) }}"
                           class="customer-order-detail-link">

                            Lihat Detail
                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>

                </article>

            @empty

                {{-- Tampilan Saat Belum Ada Pesanan --}}
                <div class="customer-orders-empty">

                    <div class="customer-orders-empty-icon">
                        <i class="bi bi-bag"></i>
                    </div>

                    <h2 class="h5 fw-bold mb-2"
                        style="color: #243047;">
                        Belum Ada Pesanan
                    </h2>

                    <p class="small text-secondary mx-auto mb-4"
                       style="max-width: 390px; line-height: 1.9;">
                        Pesanan katering yang kamu buat akan muncul di halaman ini.
                        Yuk, temukan menu yang sesuai dengan kebutuhanmu.
                    </p>

                    <a href="{{ route('customer.caterings.index') }}"
                       class="customer-orders-primary-link">
                        <i class="bi bi-search"></i>
                        Jelajahi Menu Katering
                    </a>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if ($orders->hasPages())
            <div class="customer-orders-pagination">
                {{ $orders->links() }}
            </div>
        @endif

    </div>
@endsection
