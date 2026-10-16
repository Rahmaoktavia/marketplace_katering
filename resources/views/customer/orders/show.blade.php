@extends('customer.layouts.main')

@section('title', 'Detail Pesanan')

@section('content')
    @php
        $orderStatusLabels = [
            'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
            'dikonfirmasi' => 'Dikonfirmasi',
            'diproses' => 'Sedang Diproses',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];

        $orderStatusStyles = [
            'menunggu_konfirmasi' => 'background: #fff7df; color: #946200; border: 1px solid #f5e4aa;',
            'dikonfirmasi' => 'background: #e8f3ff; color: #2769a8; border: 1px solid #d4e5fa;',
            'diproses' => 'background: #e8f6ff; color: #16719b; border: 1px solid #cceafa;',
            'selesai' => 'background: #f0fdf4; color: #23834d; border: 1px solid #d2ecd9;',
            'dibatalkan' => 'background: #fff1f1; color: #b42318; border: 1px solid #f5d0ce;',
        ];

        $paymentStatus = $order->payment?->status_pembayaran;

        $paymentStatusLabels = [
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'berhasil' => 'Berhasil',
            'gagal' => 'Gagal',
            'kedaluwarsa' => 'Kedaluwarsa',
        ];

        $paymentStatusStyles = [
            'menunggu_pembayaran' => 'background: #fff7df; color: #946200; border: 1px solid #f5e4aa;',
            'berhasil' => 'background: #f0fdf4; color: #23834d; border: 1px solid #d2ecd9;',
            'gagal' => 'background: #fff1f1; color: #b42318; border: 1px solid #f5d0ce;',
            'kedaluwarsa' => 'background: #f3f4f6; color: #596273; border: 1px solid #e1e5eb;',
        ];
    @endphp

    <div class="container-fluid px-0 pb-4">

        {{-- Header Pesanan --}}
        <section class="mb-4">

            <a href="{{ route('customer.orders.index') }}"
               class="text-decoration-none small fw-semibold d-inline-flex align-items-center gap-2 mb-3"
               style="color: #2769a8;">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Pesanan Saya
            </a>

            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">

                <div>
                    <span class="small fw-semibold"
                          style="color: #2769a8; letter-spacing: 1.5px;">
                        INFORMASI PEMESANAN
                    </span>

                    <h1 class="h2 fw-bold mt-2 mb-3"
                        style="color: #243047;">
                        Detail Pesanan
                    </h1>

                    <div class="d-flex flex-wrap align-items-center gap-2">

                        <span class="small text-secondary">
                            No. Pesanan
                        </span>

                        <span class="fw-semibold small"
                              style="color: #243047;">
                            {{ $order->nomor_pesanan }}
                        </span>

                        <button type="button"
                                class="btn btn-sm rounded-2 py-1 px-2"
                                id="copy-order-number"
                                data-order-number="{{ $order->nomor_pesanan }}"
                                title="Salin nomor pesanan"
                                aria-label="Salin nomor pesanan"
                                style="background: #e8f3ff; color: #2769a8; border: 1px solid #dce9f8;">
                            <i class="bi bi-copy"></i>
                        </button>

                        <span class="text-secondary">·</span>

                        <span class="small text-secondary">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $order->created_at?->format('d M Y, H:i') ?? '-' }}
                        </span>

                    </div>
                </div>

                <span class="badge rounded-pill px-3 py-2"
                      style="{{ $orderStatusStyles[$order->status_pesanan] ?? 'background: #f3f4f6; color: #596273; border: 1px solid #e1e5eb;' }}">
                    <i class="bi bi-circle-fill me-1"
                       style="font-size: 7px; vertical-align: middle;"></i>
                    {{ $orderStatusLabels[$order->status_pesanan] ?? ucfirst(str_replace('_', ' ', $order->status_pesanan)) }}
                </span>

            </div>
        </section>


        {{-- Konten Utama --}}
        <div class="row g-4">

            {{-- Kolom Kiri --}}
            <div class="col-xl-8">

                {{-- Informasi Pengiriman --}}
                <section class="card rounded-4 shadow-sm mb-4"
                         style="border: 1px solid #e3eaf2;">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center gap-3 mb-4">

                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                 style="width: 48px; height: 48px; background: #e8f3ff;">
                                <i class="bi bi-truck"
                                   style="font-size: 23px; color: #2769a8;"></i>
                            </div>

                            <div>
                                <h2 class="h5 fw-bold mb-1"
                                    style="color: #243047;">
                                    Informasi Pengiriman
                                </h2>

                                <p class="text-secondary small mb-0">
                                    Detail penyedia, jadwal, dan alamat tujuan.
                                </p>
                            </div>

                        </div>


                        <div class="row g-3">

                            {{-- Penyedia --}}
                            <div class="col-md-6">
                                <div class="rounded-3 p-3 h-100"
                                     style="background: #f8fbff; border: 1px solid #edf2f8;">

                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="bi bi-shop"
                                           style="color: #2769a8;"></i>

                                        <span class="small text-secondary">
                                            Penyedia Katering
                                        </span>
                                    </div>

                                    <div class="fw-semibold"
                                         style="color: #243047; line-height: 1.6;">
                                        {{ $order->merchant?->nama_perusahaan ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Tanggal Pengiriman --}}
                            <div class="col-md-6">
                                <div class="rounded-3 p-3 h-100"
                                     style="background: #f8fbff; border: 1px solid #edf2f8;">

                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="bi bi-calendar-event"
                                           style="color: #2769a8;"></i>

                                        <span class="small text-secondary">
                                            Tanggal Pengiriman
                                        </span>
                                    </div>

                                    <div class="fw-semibold"
                                         style="color: #243047;">
                                        {{ $order->tanggal_pengiriman?->format('d M Y') ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Alamat --}}
                            <div class="col-12">

                                <div class="rounded-3 p-3"
                                     style="background: #f8fbff; border: 1px solid #dce9f8;">

                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <i class="bi bi-geo-alt"
                                           style="color: #2769a8;"></i>

                                        <span class="small fw-semibold"
                                              style="color: #243047;">
                                            Alamat Pengiriman
                                        </span>
                                    </div>

                                    <p class="small mb-0"
                                       style="color: #596273; line-height: 1.9; overflow-wrap: anywhere;">
                                        {{ $order->alamat_pengiriman ?: '-' }}
                                    </p>

                                </div>

                            </div>


                            {{-- Catatan Pesanan --}}
                            @if ($order->catatan)
                                <div class="col-12">

                                    <div class="rounded-3 p-3"
                                         style="background: #ffffff; border: 1px solid #e3eaf2;">

                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="bi bi-chat-left-text"
                                               style="color: #2769a8;"></i>

                                            <span class="small fw-semibold"
                                                  style="color: #243047;">
                                                Catatan Pesanan
                                            </span>
                                        </div>

                                        <p class="small text-secondary mb-0"
                                           style="line-height: 1.8; overflow-wrap: anywhere;">
                                            {{ $order->catatan }}
                                        </p>

                                    </div>

                                </div>
                            @endif

                        </div>
                    </div>
                </section>


                {{-- Rincian Menu --}}
                <section class="card rounded-4 shadow-sm"
                         style="border: 1px solid #e3eaf2;">

                    <div class="card-body p-4">

                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

                            <div>
                                <h2 class="h5 fw-bold mb-1"
                                    style="color: #243047;">
                                    Rincian Menu
                                </h2>

                                <p class="text-secondary small mb-0">
                                    Ringkasan hidangan dalam pesananmu.
                                </p>
                            </div>

                            <div class="d-flex align-items-center flex-wrap gap-2">

                                <span class="badge rounded-pill px-3 py-2"
                                      style="background: #e8f3ff; color: #2769a8; border: 1px solid #dce9f8;">
                                    <i class="bi bi-basket2 me-1"></i>
                                    {{ number_format($order->items->sum('jumlah_porsi'), 0, ',', '.') }} porsi
                                </span>

                                @if ($order->invoice)
                                    <a href="{{ route('customer.invoices.show', $order->invoice) }}"
                                       class="btn btn-sm rounded-3 px-3"
                                       style="color: #2769a8; background: #ffffff; border: 1px solid #5289c0;">
                                        <i class="bi bi-receipt me-1"></i>
                                        Lihat Invoice
                                    </a>
                                @endif

                            </div>
                        </div>


                        <div class="table-responsive">

                            <table class="table align-middle mb-0">

                                <thead>
                                    <tr style="background: #f8fbff;">
                                        <th class="py-3 ps-3 small fw-semibold text-secondary"
                                            style="border-bottom: 1px solid #e3eaf2;">
                                            Menu
                                        </th>

                                        <th class="py-3 text-center small fw-semibold text-secondary text-nowrap"
                                            style="border-bottom: 1px solid #e3eaf2;">
                                            Porsi
                                        </th>

                                        <th class="py-3 text-end small fw-semibold text-secondary text-nowrap"
                                            style="border-bottom: 1px solid #e3eaf2;">
                                            Harga Satuan
                                        </th>

                                        <th class="py-3 text-end pe-3 small fw-semibold text-secondary text-nowrap"
                                            style="border-bottom: 1px solid #e3eaf2;">
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($order->items as $item)
                                        <tr>


                                            <td class="py-3 ps-3">
                                                <div class="customer-order-detail-menu">

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

                                                    {{-- Nama Menu --}}
                                                    <div class="customer-order-menu-details">
                                                        <div class="customer-order-menu-name mb-0">
                                                            {{ $item->nama_menu }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>

                                            <td class="py-3 text-center small">
                                                {{ number_format($item->jumlah_porsi, 0, ',', '.') }}
                                            </td>

                                            <td class="py-3 text-end text-nowrap small text-secondary">
                                                Rp{{ number_format((float) $item->harga_satuan, 0, ',', '.') }}
                                            </td>

                                            <td class="py-3 text-end pe-3 text-nowrap small fw-semibold"
                                                style="color: #243047;">
                                                Rp{{ number_format((float) $item->subtotal, 0, ',', '.') }}
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"
                                                class="text-center py-5 text-secondary">

                                                <i class="bi bi-basket2 d-block mb-2"
                                                   style="font-size: 32px; color: #8bb5df;"></i>

                                                <span class="small">
                                                    Belum ada rincian menu.
                                                </span>

                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>

                        </div>
                    </div>
                </section>

            </div>


            {{-- Kolom Kanan: Pembayaran --}}
            <div class="col-xl-4">

                <div class="card rounded-4 shadow-sm mb-4"
                     style="border: 1px solid #dce9f8;">

                    {{-- Header Ringkasan --}}
                    <div class="rounded-top-4 p-4"
                         style="background: linear-gradient(135deg, #eef6ff 0%, #ffffff 100%); border-bottom: 1px solid #e3eaf2;">

                        <div class="d-flex align-items-center gap-3">

                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                 style="width: 46px; height: 46px; background: #ffffff; border: 1px solid #dce9f8;">
                                <i class="bi bi-wallet2"
                                   style="font-size: 22px; color: #2769a8;"></i>
                            </div>

                            <div>
                                <h2 class="h5 fw-bold mb-1"
                                    style="color: #243047;">
                                    Ringkasan Pembayaran
                                </h2>

                                <p class="small text-secondary mb-0">
                                    Rincian total pesananmu.
                                </p>
                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        {{-- Status Pembayaran --}}
                        <div class="mb-4">

                            <div class="small text-secondary mb-2">
                                Status Pembayaran
                            </div>

                            <span class="badge rounded-pill px-3 py-2"
                                  style="{{ $paymentStatusStyles[$paymentStatus] ?? 'background: #f3f4f6; color: #596273; border: 1px solid #e1e5eb;' }}">

                                @if ($paymentStatus === 'berhasil')
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                @elseif (in_array($paymentStatus, ['gagal', 'kedaluwarsa'], true))
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                                @else
                                    <i class="bi bi-clock-fill me-1"></i>
                                @endif

                                {{ $paymentStatusLabels[$paymentStatus] ?? 'Belum Ada Pembayaran' }}

                            </span>

                        </div>


                        {{-- Jumlah Porsi --}}
                        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">

                            <span class="small text-secondary">
                                Jumlah Porsi
                            </span>

                            <span class="small fw-semibold"
                                  style="color: #243047;">
                                {{ number_format($order->items->sum('jumlah_porsi'), 0, ',', '.') }} porsi
                            </span>

                        </div>


                        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">

                            <span class="small text-secondary">
                                Nomor Pesanan
                            </span>

                            <span class="small fw-semibold text-end"
                                  style="color: #243047; overflow-wrap: anywhere;">
                                {{ $order->nomor_pesanan }}
                            </span>

                        </div>


                        <hr style="border-color: #e3eaf2; opacity: 1;">


                        {{-- Total Pembayaran --}}
                        <div class="rounded-3 p-3 mb-4"
                             style="background: #f1f7ff; border: 1px solid #dce9f8;">

                            <span class="small text-secondary d-block mb-2">
                                Total Pembayaran
                            </span>

                            <div class="fw-bold"
                                 style="color: #2769a8; font-size: 26px; line-height: 1.4; overflow-wrap: anywhere;">
                                Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}
                            </div>

                            <span class="small text-secondary">
                                Total sesuai rincian pesanan
                            </span>

                        </div>


                        {{-- Kondisi Pembayaran --}}
                        @if ($paymentStatus === 'berhasil')

                            <div class="rounded-3 p-3"
                                 style="background: linear-gradient(135deg, #f0fdf4, #e3f6e9); border: 1px solid #d2ecd9;">

                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-check-circle-fill mt-1"
                                       style="color: #23834d;"></i>

                                    <div>
                                        <div class="fw-semibold small mb-1"
                                             style="color: #23834d;">
                                            Pembayaran Berhasil
                                        </div>

                                        <p class="small mb-0"
                                           style="color: #426b50; line-height: 1.7;">
                                            Pembayaran untuk pesanan ini telah berhasil.
                                        </p>
                                    </div>
                                </div>

                            </div>

                        @elseif (in_array($order->status_pesanan, ['selesai', 'dibatalkan'], true))

                            <div class="rounded-3 p-3"
                                 style="background: #f3f4f6; border: 1px solid #e1e5eb;">

                                <div class="d-flex align-items-start gap-2">
                                    <i class="bi bi-info-circle mt-1 text-secondary"></i>

                                    <p class="small text-secondary mb-0"
                                       style="line-height: 1.7;">
                                        Pesanan ini tidak dapat dibayar dalam status sekarang.
                                    </p>
                                </div>

                            </div>

                        @else

                            <form action="{{ route('customer.payment.pay', $order) }}"
                                  method="POST">
                                @csrf

                                <button type="submit"
                                        class="btn w-100 rounded-3 py-3 fw-semibold"
                                        style="background: #2769a8; color: #ffffff;">

                                    <i class="bi bi-credit-card me-2"></i>

                                    {{ in_array($paymentStatus, ['gagal', 'kedaluwarsa'], true)
                                        ? 'Coba Bayar Lagi'
                                        : 'Bayar Sekarang' }}

                                    <i class="bi bi-arrow-right ms-2"></i>

                                </button>
                            </form>

                            <div class="d-flex justify-content-center align-items-center gap-2 mt-3">

                                <i class="bi bi-shield-check"
                                   style="color: #23834d;"></i>

                                <span class="small text-secondary">
                                    Pembayaran diproses melalui Midtrans.
                                </span>

                            </div>

                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('copy-order-number')?.addEventListener('click', async function () {
                const button = this;
                const orderNumber = button.dataset.orderNumber;

                try {
                    await navigator.clipboard.writeText(orderNumber);

                    button.innerHTML = '<i class="bi bi-check2"></i>';
                    button.title = 'Nomor pesanan tersalin';
                    button.setAttribute('aria-label', 'Nomor pesanan tersalin');
                } catch (error) {
                    window.prompt('Salin nomor pesanan berikut:', orderNumber);
                }
            });
        </script>
    @endpush

@endsection