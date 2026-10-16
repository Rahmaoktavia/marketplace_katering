@extends('layouts.auth')

@section('title', 'Daftar Merchant')

@section('content')
    <div class="register-brand">
        <div class="register-logo">
            <i class="bi bi-shop" aria-hidden="true"></i>
        </div>
        <h1>Marketplace Katering</h1>
        <div class="brand-decoration"></div>
    </div>

    <div class="register-heading">
        <h2>Buat Akun Merchant</h2>
    </div>

    @if ($errors->any())
        <div class="register-alert" role="alert">
            <i class="bi bi-exclamation-circle" aria-hidden="true"></i>
            Periksa kembali data yang kamu masukkan.
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <input type="hidden" name="role" value="merchant">

        <div class="register-field">
            <label for="nama_perusahaan">Nama Usaha Katering</label>
            <input
                type="text"
                id="nama_perusahaan"
                name="nama_perusahaan"
                value="{{ old('nama_perusahaan') }}"
                placeholder="Masukkan nama usaha katering"
                maxlength="150"
                autocomplete="organization"
                required
                autofocus
            >
            @error('nama_perusahaan')
                <small class="register-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="register-field">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="nama@email.com"
                maxlength="150"
                autocomplete="email"
                required
            >
            @error('email')
                <small class="register-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="register-field">
            <label for="password">Password</label>
            <div class="password-wrapper">
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >
                <button
                    type="button"
                    class="password-toggle"
                    data-target="password"
                    aria-label="Tampilkan password"
                    aria-pressed="false"
                >
                    <i class="bx bx-hide" aria-hidden="true"></i>
                </button>
            </div>
            @error('password')
                <small class="register-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="register-field">
            <label for="password_confirmation">
                Konfirmasi Password
            </label>
            <div class="password-wrapper">
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Masukkan kembali password"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >
                <button
                    type="button"
                    class="password-toggle"
                    data-target="password_confirmation"
                    aria-label="Tampilkan konfirmasi password"
                    aria-pressed="false"
                >
                    <i class="bx bx-hide" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-register">
            Buat Akun Merchant
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </button>
    </form>

    <p class="register-login">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login di sini</a>
    </p>

    <p class="register-back">
        <a href="{{ route('register') }}">
            <i class="bi bi-arrow-left" aria-hidden="true"></i>
            Kembali pilih jenis akun
        </a>
    </p>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.password-toggle').forEach(function (button) {
    button.addEventListener('click', function () {
        const input = document.getElementById(this.dataset.target);
        const icon = this.querySelector('i');
        const show = input.type === 'password';

        input.type = show ? 'text' : 'password';
        icon.classList.toggle('bx-show', show);
        icon.classList.toggle('bx-hide', !show);

        this.setAttribute('aria-pressed', String(show));
        this.setAttribute(
            'aria-label',
            show ? 'Sembunyikan password' : 'Tampilkan password'
        );
    });
});
</script>
@endpush
