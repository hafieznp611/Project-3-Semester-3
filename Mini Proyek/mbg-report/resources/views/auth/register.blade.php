@extends('layouts.app')

@section('title', 'Register')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="login-wrap">
    <div class="login-card">

        <div class="brand">
            <div class="logo">🍱</div>
            <h1>Buat Akun</h1>
            <p>Daftar untuk mulai membuat laporan</p>
        </div>

        <form method="POST" action="{{ route('register.proses') }}">
            @csrf

            <div class="field">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap"
                       value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap"
                       class="@error('nama_lengkap') is-invalid @enderror" required autofocus>
                @error('nama_lengkap')
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                       value="{{ old('username') }}" placeholder="Masukkan username"
                       class="@error('username') is-invalid @enderror" required>
                @error('username')
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}" placeholder="contoh@email.com"
                       class="@error('email') is-invalid @enderror" required>
                @error('email')
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="no_hp">No. HP</label>
                <input type="text" id="no_hp" name="no_hp"
                       value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx"
                       class="@error('no_hp') is-invalid @enderror">
                @error('no_hp')
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="Minimal 8 karakter"
                       class="@error('password') is-invalid @enderror" required>
                @error('password')
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       placeholder="Ulangi password" required>
            </div>

            <button type="submit" class="btn">Daftar</button>
        </form>

        <p class="auth-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </p>

    </div>
</div>
@endsection