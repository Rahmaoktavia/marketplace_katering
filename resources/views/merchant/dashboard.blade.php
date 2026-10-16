@extends('merchant.layouts.main')

@section('title', 'Dashboard Merchant')

@section('content')
    <div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h1>Dashboard Merchant</h1>
        </div>
    </div>

    {{-- Ringkasan --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <a href="{{ route('merchant.menus.index') }}"
               class="text-decoration-none text-reset">
                <div class="panel h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small text-secondary mb-2">Total Menu</div>
                            <div class="fs-3 fw-bold">{{ $totalMenu }}</div>
                            <div class="small text-secondary mt-1">Semua menu terdaftar</div>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                             style="width: 46px; height: 46px; background: #e8f0ff; color: #315fc4;">
                            <i class="bi bi-journal-richtext fs-4"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <a href="{{ route('merchant.menus.index') }}"
               class="text-decoration-none text-reset">
                <div class="panel h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small text-secondary mb-2">Menu Tersedia</div>
                            <div class="fs-3 fw-bold">{{ $menuTersedia }}</div>
                            <div class="small text-secondary mt-1">Siap dipesan customer</div>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                             style="width: 46px; height: 46px; background: #e8f7ee; color: #23834d;">
                            <i class="bi bi-check-circle fs-4"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <a href="{{ route('merchant.orders.index') }}"
               class="text-decoration-none text-reset">
                <div class="panel h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small text-secondary mb-2">Total Pesanan</div>
                            <div class="fs-3 fw-bold">{{ $totalPesanan }}</div>
                            <div class="small text-secondary mt-1">Seluruh pesanan masuk</div>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                             style="width: 46px; height: 46px; background: #fff1df; color: #a86416;">
                            <i class="bi bi-bag-check fs-4"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <a href="{{ route('merchant.orders.index') }}"
               class="text-decoration-none text-reset">
                <div class="panel h-100">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small text-secondary mb-2">Menunggu Konfirmasi</div>
                            <div class="fs-3 fw-bold">{{ $pesananMenunggu }}</div>
                            <div class="small text-secondary mt-1">Perlu ditindaklanjuti</div>
                        </div>
                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                             style="width: 46px; height: 46px; background: #fff0f0; color: #c03945;">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-xl-7">
            <div class="panel h-100">
                <div class="mb-3">
                    <h2 class="h5 fw-semibold mb-1">Tren Pesanan</h2>
                    <p class="small text-secondary mb-0">
                        Jumlah pesanan per hari selama 7 hari terakhir, tidak termasuk pesanan dibatalkan.
                    </p>
                </div>

                <div style="position: relative; height: 300px;">
                    <canvas id="orderTrendChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-5">
            <div class="panel h-100">
                <div class="mb-3">
                    <h2 class="h5 fw-semibold mb-1">Menu Terlaris</h2>
                    <p class="small text-secondary mb-0">
                        Berdasarkan total porsi dari pesanan yang tidak dibatalkan.
                    </p>
                </div>

                @if ($menuTerlaris->isNotEmpty())
                    <div style="position: relative; height: 300px;">
                        <canvas id="bestSellingChart"></canvas>
                    </div>
                @else
                    <div class="d-flex flex-column align-items-center justify-content-center text-center text-secondary"
                         style="min-height: 250px;">
                        <i class="bi bi-bar-chart fs-1 mb-2"></i>
                        <div class="fw-semibold">Belum ada data menu terlaris</div>
                        <small>Data akan muncul setelah terdapat pesanan.</small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Pesanan terbaru --}}
    <div class="panel">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <div>
                <h2 class="h5 fw-semibold mb-1">Pesanan Terbaru</h2>
                <p class="small text-secondary mb-0">
                    Lima pesanan terakhir yang masuk.
                </p>
            </div>

            <a href="{{ route('merchant.orders.index') }}"
               class="btn btn-sm btn-outline-primary">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Nama Customer</th>
                        <th>Tanggal Pengiriman</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesananTerbaru as $order)
                        @php
                            $statusClass = match ($order->status_pesanan) {
                                'menunggu_konfirmasi' => 'text-bg-warning',
                                'dikonfirmasi' => 'text-bg-info',
                                'diproses' => 'text-bg-primary',
                                'selesai' => 'text-bg-success',
                                'dibatalkan' => 'text-bg-danger',
                                default => 'text-bg-secondary',
                            };
                        @endphp

                        <tr>
                            <td class="fw-semibold">{{ $order->nomor_pesanan }}</td>
                            <td>{{ $order->customer?->nama_perusahaan ?? '-' }}</td>
                            <td>
                                {{ $order->tanggal_pengiriman
                                    ? \Carbon\Carbon::parse($order->tanggal_pengiriman)->translatedFormat('d M Y')
                                    : '-' }}
                            </td>
                            <td class="text-nowrap">
                                Rp{{ number_format((float) $order->total_harga, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status_pesanan)) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('merchant.orders.show', $order) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-secondary">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada pesanan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const orderCanvas = document.getElementById('orderTrendChart');

            if (orderCanvas) {
                new Chart(orderCanvas, {
                    type: 'line',
                    data: {
                        labels: @json($labelGrafikPesanan),
                        datasets: [{
                            label: 'Jumlah Pesanan',
                            data: @json($dataGrafikPesanan),
                            borderColor: '#315fc4',
                            backgroundColor: 'rgba(49, 95, 196, 0.12)',
                            fill: true,
                            tension: 0.3,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }

            const bestCanvas = document.getElementById('bestSellingChart');

            if (bestCanvas) {
                new Chart(bestCanvas, {
                    type: 'bar',
                    data: {
                        labels: @json($menuTerlaris->pluck('nama_menu')->values()),
                        datasets: [{
                            label: 'Total Porsi',
                            data: @json($menuTerlaris->pluck('total_porsi')->values()),
                            backgroundColor: '#23834d',
                            borderRadius: 6,
                            maxBarThickness: 32
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
