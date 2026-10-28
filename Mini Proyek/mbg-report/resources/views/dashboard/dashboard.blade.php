@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<header class="topbar">
    <div class="topbar-brand">🍱 MBG Report</div>

    <div class="topbar-user">
        <span>{{ $user->nama_lengkap }} <small>({{ $user->role }})</small></span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Keluar</button>
        </form>
    </div>
</header>

<main class="container">
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <h2>Halo, {{ $user->nama_lengkap }} 👋</h2>
    <p class="subtitle">Selamat datang di sistem pelaporan MBG.</p>

    @can('reviewing')
        <div class="cards">
            <div class="card">
                <p class="card-label">Total Laporan</p>
                <p class="card-value">0</p>
            </div>
            <div class="card">
                <p class="card-label">Menunggu</p>
                <p class="card-value">0</p>
            </div>
            <div class="card">
                <p class="card-label">Selesai</p>
                <p class="card-value">0</p>
            </div>
        </div>

        <div class="panel">
            <h3>Laporan Terbaru</h3>
            <p class="empty">Belum ada laporan.</p>
        </div>
    @endcan

    @can('report')
    <div class="cards">
        <a href="{{ route('reports.create') }}" class="btn">Buat Laporan</a>

    </div>
@endcan

</main>
@endsection