@extends('merchant.layouts.main')

@section('title', 'Profil Usaha')

@section('content')
    <div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1>Profil Usaha</h1>
        </div>

        <a href="{{ route('merchant.profile.edit') }}" class="btn btn-primary">
            <i class="bi bi-pencil-square me-1"></i>
            Edit Profil
        </a>
    </div>

    {{-- Informasi Profil Usaha --}}
    <div class="panel">
        {{-- Identitas Usaha --}}
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                 style="width: 60px; height: 60px; background: var(--primary-light); color: var(--primary);">
                <i class="bi bi-shop fs-2"></i>
            </div>

            <div>
                <h4 class="mb-1">{{ $merchant->nama_perusahaan }}</h4>
                <span class="text-secondary">Usaha Katering</span>
            </div>
        </div>

        <hr>

        {{-- Kota dan Kontak --}}
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <h6 class="fw-semibold">
                    <i class="bi bi-geo-alt me-2 text-primary"></i>Kota
                </h6>
                <p class="text-secondary mb-0">
                    {{ $merchant->kota ?: 'Belum diisi.' }}
                </p>
            </div>

            <div class="col-md-6 mb-3">
                <h6 class="fw-semibold">
                    <i class="bi bi-telephone me-2 text-primary"></i>Kontak
                </h6>
                <p class="text-secondary mb-0">
                    {{ $merchant->kontak ?: 'Belum diisi.' }}
                </p>
            </div>
        </div>

        {{-- Alamat Usaha --}}
        <div class="mb-4">
            <h6 class="fw-semibold">
                <i class="bi bi-pin-map me-2 text-primary"></i>Alamat Usaha
            </h6>
            <p class="text-secondary mb-0"
               style="white-space: pre-line;">{{ $merchant->alamat ?: 'Belum ada alamat usaha.' }}</p>
        </div>

        {{-- Deskripsi Usaha --}}
        <div class="mb-2">
            <h6 class="fw-semibold">
                <i class="bi bi-card-text me-2 text-primary"></i>Deskripsi Usaha
            </h6>
            <p class="text-secondary mb-0"
               style="white-space: pre-line;">{{ $merchant->deskripsi ?: 'Belum ada deskripsi usaha.' }}</p>
        </div>
    </div>
@endsection
