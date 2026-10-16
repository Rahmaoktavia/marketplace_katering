@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-page">

        {{-- Judul di tengah --}}
        <div class="login-heading">
            <h1 class="auth-title">Login</h1>
            <p>Selamat datang kembali! Silakan masuk ke akun kamu.</p>
        </div>

        {{-- Notifikasi status --}}
        @if (session('status'))
            <div class="login-status" role="status">
                {{ session('status') }}
            </div>
        @endif

        {{-- Form Login --}}
        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <div class="login-field">
                <label for="email" class="login-label">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="login-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    autofocus
                    required
                >

                @error('email')
                    <div class="login-field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="login-field">
                <label for="password" class="login-label">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="login-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >

                @error('password')
                    <div class="login-field-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="login-submit">
                <span>Login ke Akun</span>
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <path d="M5 12h14"/>
                    <path d="m12 5 7 7-7 7"/>
                </svg>
            </button>
        </form>

        {{-- Link Registrasi --}}
        <div class="login-footer">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>

    </div>
@endsection
