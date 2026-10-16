
@extends('customer.layouts.main')

@section('title', 'Pembayaran')

@section('content')

    {{-- Header --}}
    <section class="mb-4">

        <div>
            <span class="small fw-semibold"
                  style="color: #2769a8; letter-spacing: 1.5px;">
                PEMBAYARAN PESANAN
            </span>

            <h1 class="h2 fw-bold mt-2 mb-2"
                style="color: #243047;">
                Selesaikan Pembayaran
            </h1>

            <p class="text-secondary mb-0"
               style="line-height: 1.8;">
                Periksa kembali ringkasan pesananmu, lalu lanjutkan
                pembayaran melalui metode yang tersedia.
            </p>
        </div>

    </section>


    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4"
             role="alert">

            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"></button>
        </div>
    @endif


    {{-- Konten Pembayaran --}}
    <div class="row g-4 align-items-start">

        {{-- Kolom Kiri: Informasi Pembayaran --}}
        <div class="col-lg-7">

            {{-- Metode Pembayaran --}}
            <div class="payment-card mb-4">

                <div class="card-body p-4 p-md-5">

                    <div class="d-flex align-items-center gap-3 mb-4">

                        <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                             style="width: 52px; height: 52px; background: #e8f3ff;">

                            <i class="bi bi-credit-card"
                               style="font-size: 26px; color: #2769a8;"></i>

                        </div>

                        <div>
                            <h2 class="h5 fw-bold mb-1"
                                style="color: #243047;">
                                Metode Pembayaran
                            </h2>

                            <p class="small text-secondary mb-0">
                                Pembayaran diproses melalui Midtrans.
                            </p>
                        </div>

                    </div>


                    {{-- Informasi Midtrans --}}
                    <div class="payment-method-info p-3 p-md-4">

                        <div class="d-flex align-items-start gap-3">

                            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                                 style="width: 44px; height: 44px; background: #ffffff; border: 1px solid #dce9f8;">

                                <i class="bi bi-shield-check"
                                   style="font-size: 22px; color: #2769a8;"></i>

                            </div>

                            <div class="flex-grow-1">
                                <h3 class="h6 fw-bold mb-2"
                                    style="color: #243047;">
                                    Pembayaran melalui Midtrans
                                </h3>

                                <p class="small text-secondary mb-0"
                                   style="line-height: 1.9;">
                                    Klik tombol pembayaran untuk membuka halaman
                                    pembayaran Midtrans. Pilih metode yang tersedia
                                    dan ikuti petunjuk yang ditampilkan.
                                </p>
                            </div>

                        </div>

                    </div>


                    {{-- Panduan Pembayaran --}}
                    <div class="mt-4">

                        <h3 class="h6 fw-bold mb-3"
                            style="color: #243047;">
                            Cara Menyelesaikan Pembayaran
                        </h3>

                        <div class="d-flex align-items-start gap-3 mb-3">

                            <div class="payment-step-icon">
                                <i class="bi bi-credit-card-2-front"></i>
                            </div>

                            <div>
                                <div class="fw-semibold small mb-1"
                                     style="color: #243047;">
                                    1. Buka halaman pembayaran
                                </div>

                                <p class="small text-secondary mb-0"
                                   style="line-height: 1.8;">
                                    Tekan tombol Lanjutkan Pembayaran untuk
                                    membuka halaman pembayaran.
                                </p>
                            </div>

                        </div>

                        <div class="d-flex align-items-start gap-3 mb-3">

                            <div class="payment-step-icon">
                                <i class="bi bi-wallet2"></i>
                            </div>

                            <div>
                                <div class="fw-semibold small mb-1"
                                     style="color: #243047;">
                                    2. Pilih metode yang tersedia
                                </div>

                                <p class="small text-secondary mb-0"
                                   style="line-height: 1.8;">
                                    Ikuti instruksi pembayaran sesuai metode
                                    yang kamu pilih di Midtrans.
                                </p>
                            </div>

                        </div>

                        <div class="d-flex align-items-start gap-3">

                            <div class="payment-step-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>

                            <div>
                                <div class="fw-semibold small mb-1"
                                     style="color: #243047;">
                                    3. Periksa status pembayaran
                                </div>

                                <p class="small text-secondary mb-0"
                                   style="line-height: 1.8;">
                                    Setelah pembayaran, periksa status pesanan
                                    untuk mengetahui perkembangan transaksimu.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>


        {{-- Kolom Kanan: Ringkasan Transaksi --}}
        <div class="col-lg-5">

            <div class="payment-card">

                {{-- Header Ringkasan --}}
                <div class="rounded-top-4 p-4"
                     style="background: linear-gradient(135deg, #eef6ff 0%, #ffffff 100%); border-bottom: 1px solid #e3eaf2;">

                    <div class="d-flex align-items-center gap-3">

                        <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                             style="width: 46px; height: 46px; background: #ffffff; border: 1px solid #dce9f8;">

                            <i class="bi bi-receipt"
                               style="font-size: 22px; color: #2769a8;"></i>

                        </div>

                        <div>
                            <h2 class="h5 fw-bold mb-1"
                                style="color: #243047;">
                                Ringkasan Pesanan
                            </h2>

                            <p class="small text-secondary mb-0">
                                Pastikan informasi sudah benar.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    {{-- Nomor Pesanan --}}
                    <div class="mb-4">

                        <span class="small text-secondary d-block mb-2">
                            Nomor Pesanan
                        </span>

                        <div class="d-flex align-items-center gap-2">

                            <span class="fw-semibold flex-grow-1"
                                  style="color: #243047; overflow-wrap: anywhere;">
                                {{ $order->nomor_pesanan }}
                            </span>

                            <button type="button"
                                    id="copy-payment-order-number"
                                    data-order-number="{{ $order->nomor_pesanan }}"
                                    class="btn btn-sm rounded-2 flex-shrink-0"
                                    style="color: #2769a8; background: #e8f3ff; border: 1px solid #dce9f8;"
                                    aria-label="Salin nomor pesanan"
                                    title="Salin nomor pesanan">

                                <i class="bi bi-copy"></i>

                            </button>

                        </div>

                    </div>


                    {{-- Tanggal Pemesanan --}}
                    <div class="d-flex justify-content-between align-items-start gap-3 mb-3">

                        <span class="small text-secondary">
                            Tanggal Pesanan
                        </span>

                        <span class="small fw-semibold text-end"
                              style="color: #243047;">
                            {{ $order->created_at?->format('d M Y, H:i') ?? '-' }}
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


                    <hr style="border-color: #e3eaf2; opacity: 1;">


                    {{-- Total Pembayaran --}}
                    <div class="payment-total-card p-3 p-md-4 mb-4">

                        <span class="small text-secondary d-block mb-2">
                            TOTAL PEMBAYARAN
                        </span>

                        <div class="fw-bold mb-2"
                             style="font-size: clamp(25px, 4vw, 32px); color: #2769a8; overflow-wrap: anywhere;">

                            Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}

                        </div>

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-shield-check"
                               style="color: #23834d;"></i>

                            <span class="small text-secondary">
                                Total sesuai data pesanan
                            </span>

                        </div>

                    </div>


                    {{-- Tombol Pembayaran --}}
                    <button type="button"
                            id="pay-button"
                            class="btn payment-primary-button w-100 rounded-3 py-3 fw-semibold">

                        <i class="bi bi-lock-fill me-2"></i>
                        Lanjutkan Pembayaran
                        <i class="bi bi-arrow-right ms-2"></i>

                    </button>


                    {{-- Informasi Keamanan --}}
                    <div class="d-flex justify-content-center align-items-center gap-2 mt-3">

                        <i class="bi bi-shield-check"
                           style="color: #23834d;"></i>

                        <span class="small text-secondary text-center">
                            Pembayaran diproses melalui Midtrans.
                        </span>

                    </div>


                    <div class="text-center mt-4 pt-3"
                         style="border-top: 1px solid #e8edf4;">

                        <a href="{{ route('customer.orders.show', $order) }}"
                           class="text-decoration-none small fw-semibold"
                           style="color: #2769a8;">

                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali ke Detail Pesanan

                        </a>

                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script
        src="{{ $isProduction
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ $clientKey }}">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const payButton = document.getElementById('pay-button');
            const copyButton = document.getElementById('copy-payment-order-number');

            // Salin nomor pesanan.
            copyButton?.addEventListener('click', async function () {
                const orderNumber = this.dataset.orderNumber;

                try {
                    await navigator.clipboard.writeText(orderNumber);

                    this.innerHTML = '<i class="bi bi-check2"></i>';
                    this.title = 'Nomor pesanan tersalin';
                    this.setAttribute('aria-label', 'Nomor pesanan tersalin');
                } catch (error) {
                    window.prompt('Salin nomor pesanan berikut:', orderNumber);
                }
            });

            // Buka pembayaran Midtrans.
            payButton?.addEventListener('click', function () {
                if (!window.snap || typeof window.snap.pay !== 'function') {
                    alert('Halaman pembayaran belum termuat. Periksa koneksi internet dan coba muat ulang halaman.');
                    return;
                }

                const originalContent = payButton.innerHTML;

                payButton.disabled = true;
                payButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' +
                    'Membuka Pembayaran...';

                const restoreButton = function () {
                    payButton.disabled = false;
                    payButton.innerHTML = originalContent;
                };

                try {
                    window.snap.pay(@json($snapToken), {
                        onSuccess: function () {
                            window.location.href =
                                @json(route('customer.payment.success', $order));
                        },

                        onPending: function () {
                            window.location.href =
                                @json(route('customer.payment.success', $order));
                        },

                        onError: function () {
                            restoreButton();

                            alert('Pembayaran belum berhasil. Silakan periksa status transaksi sebelum mencoba kembali.');
                        },

                        onClose: function () {
                            // Menutup Snap tidak berarti pembayaran berhasil.
                            restoreButton();
                        }
                    });
                } catch (error) {
                    restoreButton();

                    alert('Halaman pembayaran gagal dibuka. Silakan coba kembali.');
                }
            });
        });
    </script>
@endpush
