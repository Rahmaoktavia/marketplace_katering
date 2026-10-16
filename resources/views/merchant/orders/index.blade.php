@extends('merchant.layouts.main')

@section('title', 'Pesanan')

@section('content')
    <div class="page-heading">
        <h1>Pesanan</h1>
    </div>

    <div class="panel">
        {{-- Form pencarian customer --}}
        <form action="{{ route('merchant.orders.index') }}"
              method="GET"
              class="row g-2 mb-4">

            <div class="col-md-6 col-lg-5">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama customer..."
                        value="{{ $search ?? '' }}"
                    >
                </div>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    Cari
                </button>
            </div>

            @if (!empty($search))
                <div class="col-auto">
                    <a href="{{ route('merchant.orders.index') }}"
                       class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Nama Customer</th>
                        <th>Tanggal Pengiriman</th>
                        <th>Total</th>
                        <th>Status Pesanan</th>
                        <th>Status Pembayaran</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $order)
                        @php
                            $statusPesananClass = match ($order->status_pesanan) {
                                'menunggu_konfirmasi' => 'text-bg-warning',
                                'dikonfirmasi' => 'text-bg-info',
                                'diproses' => 'text-bg-primary',
                                'selesai' => 'text-bg-success',
                                'dibatalkan' => 'text-bg-danger',
                                default => 'text-bg-secondary',
                            };

                            $statusPembayaran = $order->payment?->status_pembayaran;

                            $statusPembayaranClass = match ($statusPembayaran) {
                                'berhasil' => 'text-bg-success',
                                'gagal' => 'text-bg-danger',
                                'kedaluwarsa' => 'text-bg-secondary',
                                'menunggu_pembayaran' => 'text-bg-warning',
                                default => 'text-bg-secondary',
                            };
                        @endphp

                        <tr>
                            <td class="fw-semibold">
                                {{ $order->nomor_pesanan }}
                            </td>

                            <td>
                                {{ $order->customer?->nama_perusahaan ?? '-' }}
                            </td>

                            <td>
                                {{ $order->tanggal_pengiriman
                                    ? \Carbon\Carbon::parse($order->tanggal_pengiriman)->translatedFormat('d M Y')
                                    : '-' }}
                            </td>

                            <td class="text-nowrap">
                                Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="badge {{ $statusPesananClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status_pesanan)) }}
                                </span>
                            </td>

                            <td>
                                @if ($statusPembayaran)
                                    <span class="badge {{ $statusPembayaranClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $statusPembayaran)) }}
                                    </span>
                                @else
                                    <span class="text-muted">Belum tersedia</span>
                                @endif
                            </td>

                            <td class="text-end">
                                <a href="{{ route('merchant.orders.show', $order) }}"
                                   class="btn btn-sm btn-outline-primary text-nowrap">
                                    <i class="bi bi-eye me-1"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-secondary">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                @if (!empty($search))
                                    Customer dengan nama "{{ $search }}" tidak ditemukan
                                    atau belum memiliki pesanan.
                                @else
                                    Belum ada pesanan untuk usaha kamu.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
