@extends('merchant.layouts.main')

@section('title', 'Invoice ' . $invoice->nomor_invoice)

@section('content')
    @php
        $order = $invoice->order;
        $merchant = $order->merchant;
        $customer = $order->customer;
        $payment = $order->payment;

        $status = strtolower(str_replace('_', ' ', $invoice->status_pembayaran ?? ''));

        $statusLabel = match ($status) {
            'berhasil' => 'LUNAS',
            'gagal' => 'PEMBAYARAN GAGAL',
            'kedaluwarsa' => 'KEDALUWARSA',
            default => 'BELUM DIBAYAR',
        };

        $statusClass = match ($status) {
            'berhasil' => 'status-paid',
            'gagal', 'kedaluwarsa' => 'status-failed',
            default => 'status-pending',
        };

        $tanggalTerbit = $invoice->tanggal_terbit;
        $tanggalJatuhTempo = $invoice->tanggal_jatuh_tempo;
    @endphp

    <div class="container-fluid px-0 pb-4 merchant-invoice-page">

        {{-- Dokumen invoice --}}
        <div class="invoice-document">

            {{-- Header invoice --}}
            <div class="invoice-header">
                <div>
                    <div class="invoice-brand">INVOICE</div>
                    <p class="invoice-subtitle mb-0">
                        Dokumen tagihan pemesanan katering
                    </p>
                </div>

                <div class="invoice-number-block">
                    <span class="invoice-label">NOMOR INVOICE</span>
                    <h2>{{ $invoice->nomor_invoice }}</h2>

                    <span class="invoice-status {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>
            </div>

            <div class="invoice-divider"></div>

            {{-- Informasi merchant dan customer --}}
            <div class="invoice-parties">
                <div class="invoice-party">
                    <span class="invoice-label">DITERBITKAN OLEH</span>
                    <h3>{{ $merchant->nama_perusahaan ?? 'Merchant Katering' }}</h3>

                    <p>{{ $merchant->alamat ?? '-' }}</p>
                    <p>{{ $merchant->kota ?? '-' }}</p>

                    @if ($merchant->kontak)
                        <p>{{ $merchant->kontak }}</p>
                    @endif
                </div>

                <div class="invoice-party">
                    <span class="invoice-label">DITAGIHKAN KEPADA</span>
                    <h3>{{ $customer->nama_perusahaan ?? 'Customer' }}</h3>

                    <p>{{ $customer->alamat ?? '-' }}</p>
                    <p>{{ $customer->kota ?? '-' }}</p>

                    @if ($customer->kontak)
                        <p>{{ $customer->kontak }}</p>
                    @endif

                    <p class="mt-2">
                        <span class="fw-semibold">Alamat pengiriman:</span><br>
                        {{ $order->alamat_pengiriman ?: '-' }}
                    </p>
                </div>
            </div>

            {{-- Informasi invoice dan pesanan --}}
            <div class="invoice-meta">
                <div>
                    <span class="invoice-label">TANGGAL TERBIT</span>
                    <p>{{ $tanggalTerbit?->format('d M Y') ?? '-' }}</p>
                </div>

                <div>
                    <span class="invoice-label">TANGGAL PENGIRIMAN</span>
                    <p>{{ $order->tanggal_pengiriman?->format('d M Y') ?? '-' }}</p>
                </div>

                <div>
                    <span class="invoice-label">NOMOR PESANAN</span>
                    <p>{{ $order->nomor_pesanan }}</p>
                </div>

                <div>
                    <span class="invoice-label">JATUH TEMPO</span>
                    <p>{{ $tanggalJatuhTempo?->format('d M Y') ?? '-' }}</p>
                </div>
            </div>

            {{-- Rincian menu --}}
            <div class="invoice-section-title">
                <h3>Rincian Pesanan</h3>
                <p>Daftar menu dan biaya pemesanan</p>
            </div>

            <div class="table-responsive invoice-table-wrapper">
                <table class="table invoice-table">
                    <thead>
                        <tr>
                            <th style="width: 7%">No.</th>
                            <th>Deskripsi Menu</th>
                            <th class="text-center" style="width: 12%">Porsi</th>
                            <th class="text-end" style="width: 20%">Harga Satuan</th>
                            <th class="text-end" style="width: 22%">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($order->items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="invoice-menu-name">{{ $item->nama_menu }}</td>
                                <td class="text-center">
                                    {{ number_format($item->jumlah_porsi, 0, ',', '.') }}
                                </td>
                                <td class="text-end text-nowrap">
                                    Rp{{ number_format((float) $item->harga_satuan, 0, ',', '.') }}
                                </td>
                                <td class="text-end fw-semibold text-nowrap">
                                    Rp{{ number_format((float) $item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-secondary">
                                    Belum ada rincian menu untuk pesanan ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Total tagihan --}}
            <div class="invoice-total-section">
                <div class="invoice-total-note">
                    <span class="invoice-label">INFORMASI PEMBAYARAN</span>

                    <p class="invoice-payment-method">
                        Metode pembayaran:
                        <strong>
                            {{ $payment?->metode_pembayaran
                                ? ucfirst(str_replace('_', ' ', $payment->metode_pembayaran))
                                : 'Belum tersedia' }}
                        </strong>
                    </p>

                    <p class="invoice-payment-method">
                        Status transaksi:
                        <strong>
                            {{ $payment?->status_pembayaran
                                ? ucfirst(str_replace('_', ' ', $payment->status_pembayaran))
                                : 'Belum tersedia' }}
                        </strong>
                    </p>
                </div>

                <div class="invoice-total">
                    <div class="invoice-total-row">
                        <span>Total tagihan</span>
                        <span>
                            Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="invoice-grand-total">
                        <span>TOTAL PEMBAYARAN</span>
                        <strong>
                            Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>
            </div>

            {{-- Tombol aksi --}}
            <div class="invoice-actions no-print">
                <a href="{{ route('merchant.orders.show', $order) }}"
                   class="btn btn-outline-secondary rounded-3">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali ke Pesanan
                </a>

                <button type="button"
                        onclick="window.print()"
                        class="btn btn-primary rounded-3">
                    <i class="bi bi-printer me-1"></i>
                    Cetak Invoice
                </button>
            </div>

        </div>
    </div>
@endsection
