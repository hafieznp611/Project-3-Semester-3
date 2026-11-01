@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<header class="topbar">
    <div class="topbar-brand">🍱 MBG Report</div>

    <div class="topbar-link">
        @can('manage-master')
            <div class="link-nav">
                <a href="{{ route('schools.index') }}" class="nav-btn">Kelola Sekolah</a>
                <a href="{{ route('sppgs.index') }}" class="nav-btn">Kelola SPPG</a>
                <a href="{{ route('admin.users.index') }}" class="nav-btn">Kelola Role</a>
            </div>
        @endcan
    </div>


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
            <a href="{{ route('rekap.index') }}" class="card-link">Rekap</a>

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

    <div class="Search-Filter">
        <form method="GET" action="{{ route('dashboard') }}" class="filter-bar">
            <div class="filter-field">
                <label for="q">Cari</label>
                <input type="search" name="q" id="q" value="{{ $search }}"
                    placeholder="{{ $user->role === 'complainant' ? 'Judul Laporan' : 'Judul atau Nama Pelapor' }}">
            </div>

            <div class="filter-field">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="">Semua</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @selected($selectedStatus === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit">Terapkan</button>
                <a href="{{ route('dashboard') }}" class="link-reset">Reset</a>
            </div>
        </form>
    </div>
    

    @can('report')
        <div class="cards">
            <a href="{{ route('reports.create') }}" class="btn" style="text-align: center;">Buat Laporan</a>
        </div>
    @endcan


    <div class="panel">
        <h2>{{ $user->role === 'complainant' ? 'Laporan Saya' : 'Laporan Terbaru' }}</h3>

        <div class="panel-content">
             @forelse ($reports as $report)
            <div style="padding:12px 0; border-bottom:1px solid #f3f4f6">
                    <strong><h3>{{ $report->judul }}</h3></strong>
                    <p>{{ $report->user->nama_lengkap ?? '-' }}</p>
                    <p class="subtitle" style="margin:2px 0 0">
                        {{ $report->school->nama ?? '-' }} ·
                        {{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d M Y') }} ·
                        <em>{{ $report->status }}</em>
                    </p>
                    <a href="{{ route('reports.show', $report) }}" class="btn-detail">Lihat Detail</a>
                    
                </div>
                    
            @empty
                <p class="empty">
                    {{ ($search !== '' || $selectedStatus !== '')
                        ? 'Tidak ada laporan yang cocok dengan filter.'
                        : 'Belum ada laporan.' }}
                </p>

            @endforelse

            <div class="my-pagination">
                {{ $reports->links() }}
            </div>
        </div>
       
    </div>

</main>
@endsection