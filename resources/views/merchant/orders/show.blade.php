@extends('merchant.layouts.main')

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
        'menunggu_konfirmasi' => 'bg-warning-subtle text-warning-emphasis',
        'dikonfirmasi' => 'bg-primary-subtle text-primary-emphasis',
        'diproses' => 'bg-info-subtle text-info-emphasis',
        'selesai' => 'bg-success-subtle text-success-emphasis',
        'dibatalkan' => 'bg-danger-subtle text-danger-emphasis',
    ];

    $paymentStatus = $order->payment?->status_pembayaran;

    $paymentStatusLabels = [
        'menunggu_pembayaran' => 'Menunggu Pembayaran',
        'berhasil' => 'Berhasil',
        'gagal' => 'Gagal',
        'kedaluwarsa' => 'Kedaluwarsa',
    ];

    $paymentStatusStyles = [
        'menunggu_pembayaran' => 'bg-warning-subtle text-warning-emphasis',
        'berhasil' => 'bg-success-subtle text-success-emphasis',
        'gagal' => 'bg-danger-subtle text-danger-emphasis',
        'kedaluwarsa' => 'bg-secondary-subtle text-secondary-emphasis',
    ];

    $invoiceStatus = $order->invoice?->status_pembayaran;

    $invoiceStatusStyles = [
        'menunggu pembayaran' => 'bg-warning-subtle text-warning-emphasis',
        'menunggu_pembayaran' => 'bg-warning-subtle text-warning-emphasis',
        'berhasil' => 'bg-success-subtle text-success-emphasis',
        'gagal' => 'bg-danger-subtle text-danger-emphasis',
        'kedaluwarsa' => 'bg-secondary-subtle text-secondary-emphasis',
    ];
@endphp

<div class="container-fluid px-0 pb-4 merchant-detail-page">

    {{-- Header --}}

        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h1 class="h3 fw-bold mb-2">Detail Pesanan</h1>

                <div class="d-flex flex-wrap align-items-center gap-2 text-secondary small">
                    <span>{{ $order->nomor_pesanan }}</span>

                    <button type="button"
                            class="btn btn-sm btn-light border rounded-2 py-0"
                            id="copy-merchant-order-number"
                            data-order-number="{{ $order->nomor_pesanan }}"
                            title="Salin nomor pesanan"
                            aria-label="Salin nomor pesanan">
                        <i class="bi bi-copy"></i>
                    </button>

                    <span>·</span>
                    <span>{{ $order->created_at?->format('d M Y, H:i') ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- Kolom Utama --}}
        <div class="col-xl-8">

            {{-- Informasi Customer dan Pengiriman --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-3 bg-primary-subtle text-primary p-3">
                            <i class="bi bi-person-lines-fill fs-4"></i>
                        </div>
                        <div>
                            <h2 class="h5 fw-bold mb-1">Informasi Customer</h2>
                            <p class="text-secondary small mb-0">
                                Data pemesan dan tujuan pengiriman
                            </p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="text-secondary small mb-1">Nama Perusahaan</div>
                            <div class="fw-semibold">
                                {{ $order->customer?->nama_perusahaan ?? 'Customer' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-secondary small mb-1">ID Customer</div>
                            <div class="fw-semibold">
                                {{ $order->customer_id }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-secondary small mb-1">Kontak Customer</div>
                            <div class="fw-semibold">
                                {{ $order->customer?->kontak ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-secondary small mb-1">Tanggal Pengiriman</div>
                            <div class="fw-semibold">
                                <i class="bi bi-calendar-event text-secondary me-2"></i>
                                {{ $order->tanggal_pengiriman
                                    ? \Carbon\Carbon::parse($order->tanggal_pengiriman)->format('d M Y')
                                    : '-' }}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="text-secondary small mb-2">Alamat Pengiriman</div>
                            <div class="rounded-3 bg-light p-3">
                                <i class="bi bi-geo-alt text-secondary me-2"></i>
                                {{ $order->alamat_pengiriman ?: '-' }}
                            </div>
                        </div>

                        @if ($order->catatan)
                            <div class="col-12">
                                <div class="text-secondary small mb-2">Catatan Customer</div>
                                <div class="rounded-3 border p-3">
                                    <i class="bi bi-chat-left-text text-secondary me-2"></i>
                                    {{ $order->catatan }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Rincian Menu --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div>
                            <h2 class="h5 fw-bold mb-1">Rincian Menu</h2>
                            <p class="text-secondary small mb-0">
                                Daftar menu yang dipesan customer
                            </p>
                        </div>

                        <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                            <i class="bi bi-basket2 me-1"></i>
                            {{ $order->items->sum('jumlah_porsi') }} porsi
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr class="text-secondary small">
                                    <th class="border-bottom py-3 ps-0 fw-medium">Menu</th>
                                    <th class="border-bottom py-3 text-center fw-medium">Porsi</th>
                                    <th class="border-bottom py-3 text-end fw-medium">Harga Satuan</th>
                                    <th class="border-bottom py-3 text-end pe-0 fw-medium">Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($order->items as $item)
                                    <tr>
                                        <td class="py-3 ps-0">
                                            <span class="fw-semibold">{{ $item->nama_menu }}</span>
                                        </td>
                                        <td class="py-3 text-center">
                                            {{ number_format($item->jumlah_porsi, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 text-end text-nowrap text-secondary">
                                            Rp{{ number_format((float) $item->harga_satuan, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 text-end pe-0 text-nowrap fw-semibold">
                                            Rp{{ number_format((float) $item->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-secondary">
                                            <i class="bi bi-basket fs-2 d-block mb-2"></i>
                                            Belum ada rincian menu.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 border-top mt-3 pt-4">
                        <div>
                            <div class="fw-semibold">Total Pesanan</div>
                            <div class="text-secondary small">
                                {{ $order->items->sum('jumlah_porsi') }} porsi
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3">
                            <span class="h5 fw-bold text-primary text-sm-end mb-0">
                                Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}
                            </span>

                            @if ($order->invoice)
                                <a href="{{ route('merchant.invoices.show', $order->invoice) }}"
                                class="btn btn-outline-primary rounded-3">
                                    <i class="bi bi-receipt me-2"></i>
                                    Lihat Invoice
                                </a>
                            @else
                                <button type="button"
                                        class="btn btn-outline-secondary rounded-3"
                                        disabled>
                                    <i class="bi bi-receipt me-2"></i>
                                    Invoice Belum Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Merchant --}}
        <div class="col-xl-4">

            {{-- Kelola Status --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-3 bg-primary-subtle text-primary p-3">
                            <i class="bi bi-arrow-left-right fs-4"></i>
                        </div>
                        <div>
                            <h2 class="h5 fw-bold mb-1">Kelola Pesanan</h2>
                            <p class="text-secondary small mb-0">
                                Perbarui progres pesanan
                            </p>
                        </div>
                    </div>

                    <div class="text-secondary small mb-2">Status saat ini</div>
                    <div class="mb-4">
                        <span class="badge rounded-pill px-3 py-2 {{ $orderStatusStyles[$order->status_pesanan] ?? 'bg-secondary-subtle text-secondary-emphasis' }}">
                            {{ $orderStatusLabels[$order->status_pesanan] ?? ucfirst(str_replace('_', ' ', $order->status_pesanan)) }}
                        </span>
                    </div>

                    @if (!in_array($order->status_pesanan, ['selesai', 'dibatalkan'], true))
                        <form action="{{ route('merchant.orders.update-status', $order) }}"
                              method="POST">
                            @csrf
                            @method('PATCH')

                            <label for="status_pesanan" class="form-label small fw-semibold">
                                Ubah Status Pesanan
                            </label>

                            <select name="status_pesanan"
                                    id="status_pesanan"
                                    class="form-select rounded-3 mb-3"
                                    required>
                                @foreach ($orderStatusLabels as $value => $label)
                                    <option value="{{ $value }}"
                                        @selected(old('status_pesanan', $order->status_pesanan) === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary w-100 rounded-3">
                                <i class="bi bi-check2-circle me-2"></i>
                                Simpan Status
                            </button>
                        </form>
                    @else
                        <div class="alert alert-light border rounded-3 mb-0 small">
                            <i class="bi bi-info-circle me-2"></i>
                            Pesanan ini sudah berstatus final.
                        </div>
                    @endif
                </div>
            </div>

            {{-- Ringkasan Pembayaran --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h2 class="h5 fw-bold mb-4">Ringkasan Pembayaran</h2>

                    <div class="mb-4">
                        <div class="text-secondary small mb-2">Status Pembayaran</div>

                        <span class="badge rounded-pill px-3 py-2 {{ $paymentStatusStyles[$paymentStatus] ?? 'bg-light text-dark border' }}">
                            {{ $paymentStatusLabels[$paymentStatus] ?? 'Belum Ada Pembayaran' }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <div class="text-secondary small mb-1">Nomor Transaksi</div>
                        <div class="fw-semibold text-break">
                            {{ $order->payment?->nomor_transaksi ?: '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-secondary small mb-1">Metode Pembayaran</div>
                        <div class="fw-semibold">
                            {{ $order->payment?->metode_pembayaran
                                ? ucfirst(str_replace('_', ' ', $order->payment->metode_pembayaran))
                                : 'Belum tersedia' }}
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-secondary">Jumlah Porsi</span>
                        <span class="fw-semibold">
                            {{ $order->items->sum('jumlah_porsi') }} porsi
                        </span>
                    </div>

                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <span class="fw-bold">Total Pesanan</span>
                        <span class="h5 fw-bold text-primary text-end mb-0">
                            Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('copy-merchant-order-number')?.addEventListener('click', async function () {
        const orderNumber = this.dataset.orderNumber;

        try {
            await navigator.clipboard.writeText(orderNumber);
            this.innerHTML = '<i class="bi bi-check2"></i>';
            this.title = 'Nomor pesanan tersalin';
        } catch (error) {
            alert('Nomor pesanan: ' + orderNumber);
        }
    });
</script>
@endpush
@endsection
