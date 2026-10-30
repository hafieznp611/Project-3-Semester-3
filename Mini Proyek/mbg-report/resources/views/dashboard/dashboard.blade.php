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
                <p class="card-value">{{ $total }}</p>
            </div>
            <div class="card">
                <p class="card-label">Menunggu</p>
                <p class="card-value">{{ $menunggu }}</p>
            </div>
            <div class="card">
                <p class="card-label">Selesai</p>
                <p class="card-value">{{ $selesai }}</p>
            </div>
        </div>
    @endcan

    @can('report')
        <div class="cards">
            <a href="{{ route('reports.create') }}" class="btn">Buat Laporan</a>
        </div>
    @endcan


    <div class="panel">
        <h3>{{ $user->role === 'complainant' ? 'Laporan Saya' : 'Laporan Terbaru' }}</h3>

        @forelse ($reports as $report)
            <div style="padding:12px 0; border-bottom:1px solid #f3f4f6">
                <strong>{{ $report->judul }}</strong>
                <p class="subtitle" style="margin:2px 0 0">
                    {{ $report->school->nama ?? '-' }} ·
                    {{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d M Y') }} ·
                    <em>{{ $report->status }}</em>
                </p>
                <a href="{{ route('reports.show', $report) }}" class="btn-detail">Lihat Detail</a>
                   
            </div>
                
        @empty
            <p class="empty">Belum ada laporan.</p>

        @endforelse

        <div class="my-pagination">
            {{ $reports->links() }}
        </div>
    </div>

</main>
@endsection