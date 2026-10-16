@extends('customer.layouts.main')

@section('title', 'Status Pembayaran')

@section('content')
    <div class="page-heading mb-4">
        <h1>Status Pembayaran</h1>
    </div>

    <div class="panel text-center py-5">
        @if ($payment && $payment->status_pembayaran === 'berhasil')
            <i class="bi bi-check-circle-fill text-success"
               style="font-size: 4rem;"></i>

            <h2 class="h4 fw-bold mt-3">Pembayaran Berhasil</h2>

            <p class="text-secondary">
                Pembayaran pesanan kamu telah berhasil dikonfirmasi.
            </p>
        @elseif ($payment && $payment->status_pembayaran === 'menunggu_pembayaran')
            <i class="bi bi-clock-history text-warning"
               style="font-size: 4rem;"></i>

            <h2 class="h4 fw-bold mt-3">Menunggu Pembayaran</h2>

            <p class="text-secondary">
                Pembayaran belum dikonfirmasi. Silakan periksa statusnya kembali.
            </p>
        @elseif ($payment && $payment->status_pembayaran === 'kedaluwarsa')
            <i class="bi bi-exclamation-circle text-warning"
               style="font-size: 4rem;"></i>

            <h2 class="h4 fw-bold mt-3">Pembayaran Kedaluwarsa</h2>

            <p class="text-secondary">
                Batas waktu pembayaran telah berakhir.
            </p>
        @elseif ($payment && $payment->status_pembayaran === 'gagal')
            <i class="bi bi-x-circle text-danger"
               style="font-size: 4rem;"></i>

            <h2 class="h4 fw-bold mt-3">Pembayaran Gagal</h2>

            <p class="text-secondary">
                Pembayaran belum berhasil. Kamu dapat mencoba kembali jika pesanan masih bisa dibayar.
            </p>
        @else
            <i class="bi bi-hourglass-split text-secondary"
               style="font-size: 4rem;"></i>

            <h2 class="h4 fw-bold mt-3">Status Belum Tersedia</h2>

            <p class="text-secondary">
                Data pembayaran belum tersedia. Silakan periksa detail pesanan.
            </p>
        @endif

        <hr class="my-4">

        <div class="mb-3">
            <p class="text-secondary mb-1">Nomor pesanan</p>
            <h3 class="h6 fw-bold">{{ $order->nomor_pesanan }}</h3>
        </div>

        <div class="mb-4">
            <p class="text-secondary mb-1">Total pembayaran</p>
            <h3 class="h5 fw-bold">
                Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}
            </h3>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ route('customer.orders.show', $order) }}"
               class="btn btn-primary">
                Lihat Detail Pesanan
            </a>

            <a href="{{ route('customer.orders.index') }}"
               class="btn btn-outline-secondary">
                Daftar Pesanan
            </a>

            @if ($payment && in_array(
                $payment->status_pembayaran,
                ['gagal', 'kedaluwarsa'],
                true
            ) && !in_array($order->status_pesanan, ['selesai', 'dibatalkan'], true))
                <form action="{{ route('customer.payment.pay', $order) }}"
                      method="POST">
                    @csrf

                    <button type="submit" class="btn btn-success">
                        Coba Bayar Lagi
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection
