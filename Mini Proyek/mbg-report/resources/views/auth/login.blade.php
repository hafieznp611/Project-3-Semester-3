@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="login-wrap">
    <div class="login-card">

        <div class="brand">
            <div class="logo">🍱</div>
            <h1>MBG Report</h1>
            <p>Masuk untuk melanjutkan</p>
        </div>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login.proses') }}">
            @csrf

            <div class="field">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    class="@error('username') is-invalid @enderror"
                    required
                    autofocus
                >
                @error('username')
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
                @error('password')
                    <p class="err">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Masuk</button>
        </form>

        <p class="auth-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </p>

    </div>
</div>
@endsection