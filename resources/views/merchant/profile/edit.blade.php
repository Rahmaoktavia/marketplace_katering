@extends('merchant.layouts.main')

@section('title', 'Edit Profil Usaha')

@section('content')
    <div class="page-heading">
        <h1>Edit Profil Usaha</h1>
        <p>Perbarui informasi usaha katering agar customer dapat mengenal usahamu.</p>
    </div>

    <div class="panel">
        <form action="{{ route('merchant.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Usaha --}}
            <div class="mb-4">
                <label for="nama_perusahaan" class="form-label">
                    Nama Usaha Katering <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nama_perusahaan"
                    id="nama_perusahaan"
                    class="form-control @error('nama_perusahaan') is-invalid @enderror"
                    value="{{ old('nama_perusahaan', $merchant->nama_perusahaan) }}"
                    placeholder="Contoh: Dapur Bunda"
                    maxlength="150"
                    required
                >

                @error('nama_perusahaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kota dan Kontak --}}
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="kota" class="form-label">Kota</label>

                    <input
                        type="text"
                        name="kota"
                        id="kota"
                        class="form-control @error('kota') is-invalid @enderror"
                        value="{{ old('kota', $merchant->kota) }}"
                        placeholder="Contoh: Padang"
                        maxlength="100"
                    >

                    @error('kota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="kontak" class="form-label">Kontak</label>

                    <input
                        type="text"
                        name="kontak"
                        id="kontak"
                        class="form-control @error('kontak') is-invalid @enderror"
                        value="{{ old('kontak', $merchant->kontak) }}"
                        placeholder="Contoh: 081234567890"
                        maxlength="20"
                    >

                    @error('kontak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Alamat Usaha --}}
            <div class="mb-4">
                <label for="alamat" class="form-label">Alamat Usaha</label>

                <textarea
                    name="alamat"
                    id="alamat"
                    rows="3"
                    class="form-control @error('alamat') is-invalid @enderror"
                    placeholder="Masukkan alamat lengkap usaha katering."
                >{{ old('alamat', $merchant->alamat) }}</textarea>

                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi Usaha --}}
            <div class="mb-4">
                <label for="deskripsi" class="form-label">Deskripsi Usaha</label>

                <textarea
                    name="deskripsi"
                    id="deskripsi"
                    rows="4"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                    placeholder="Ceritakan tentang usaha, pilihan hidangan, dan layanan katering yang ditawarkan."
                >{{ old('deskripsi', $merchant->deskripsi) }}</textarea>

                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('merchant.profile.index') }}"
                   class="btn btn-outline-secondary">
                    Batal
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection

