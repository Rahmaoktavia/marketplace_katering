@extends('customer.layouts.main')

@section('title', 'Profil Usaha')

@section('content')
<div class="container py-4 customer-profile-page">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="customer-profile-heading">Profil Usaha</h1>
            <p class="customer-profile-subtitle">
                Kelola informasi akun dan data usaha kamu.
            </p>
        </div>

        <a href="{{ route('customer.dashboard') }}"
           class="btn customer-profile-back">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali ke Beranda
        </a>
    </div>

    {{-- Ringkasan akun --}}
    <div class="customer-profile-card mb-4">
        <div class="customer-profile-overview">
            <div class="customer-profile-avatar">
                <i class="bi bi-building"></i>
            </div>

            <div class="customer-profile-overview-info">
                <span class="customer-profile-label">
                    PROFIL CUSTOMER
                </span>

                <h2>
                    {{ $customer->nama_perusahaan ?: 'Lengkapi profil usaha kamu' }}
                </h2>

                <p>
                    <i class="bi bi-envelope me-2"></i>
                    {{ $user->email }}
                </p>
            </div>
        </div>
    </div>

    {{-- Form profil --}}
    <div class="customer-profile-card">

        <div class="customer-profile-section-header">
            <div>
                <h2>Informasi Usaha</h2>
                <p>
                    Pastikan informasi usaha dan kontak kamu sudah benar.
                </p>
            </div>

            <span class="customer-profile-section-icon">
                <i class="bi bi-card-list"></i>
            </span>
        </div>

        <form action="{{ route('customer.profile.update') }}"
              method="POST"
              class="customer-profile-form">
            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- Nama Perusahaan --}}
                <div class="col-md-6">
                    <label for="nama_perusahaan" class="form-label">
                        Nama Perusahaan
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama_perusahaan"
                        name="nama_perusahaan"
                        class="form-control {{ $errors->has('nama_perusahaan') ? 'is-invalid' : '' }}"
                        value="{{ old('nama_perusahaan', $customer->nama_perusahaan) }}"
                        placeholder="Masukkan nama perusahaan"
                        maxlength="255"
                        autocomplete="organization"
                        required
                    >

                    @error('nama_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label for="email" class="form-label">
                        Email Akun
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        value="{{ old('email', $user->email) }}"
                        placeholder="nama@email.com"
                        maxlength="255"
                        autocomplete="email"
                        required
                    >

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kontak --}}
                <div class="col-md-6">
                    <label for="kontak" class="form-label">
                        Nomor Kontak
                    </label>

                    <input
                        type="text"
                        id="kontak"
                        name="kontak"
                        class="form-control {{ $errors->has('kontak') ? 'is-invalid' : '' }}"
                        value="{{ old('kontak', $customer->kontak) }}"
                        placeholder="Contoh: 081234567890"
                        maxlength="20"
                        autocomplete="tel"
                    >

                    @error('kontak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kota --}}
                <div class="col-md-6">
                    <label for="kota" class="form-label">
                        Kota
                    </label>

                    <input
                        type="text"
                        id="kota"
                        name="kota"
                        class="form-control {{ $errors->has('kota') ? 'is-invalid' : '' }}"
                        value="{{ old('kota', $customer->kota) }}"
                        placeholder="Masukkan kota"
                        maxlength="100"
                        autocomplete="address-level2"
                    >

                    @error('kota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="col-12">
                    <label for="alamat" class="form-label">
                        Alamat Usaha
                    </label>

                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="3"
                        maxlength="1000"
                        class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan alamat lengkap usaha"
                        autocomplete="street-address"
                    >{{ old('alamat', $customer->alamat) }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- Tombol Aksi --}}
            <div class="customer-profile-form-actions">
                <a href="{{ route('customer.dashboard') }}"
                   class="btn customer-profile-cancel">
                    Batal
                </a>

                <button type="submit" class="btn customer-profile-save">
                    <i class="bi bi-check2-circle me-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
