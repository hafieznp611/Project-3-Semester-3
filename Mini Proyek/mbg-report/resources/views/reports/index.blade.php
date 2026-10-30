@extends('layouts.app')


@section('title', 'Laporan Saya')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<header class="topbar">
    <div class="topbar-brand">🍱 MBG Report</div>
    <div class="topbar-user">
        <a href="{{ route('dashboard') }}" class="link-back">← Dashboard</a>
    </div>
</header>

<main class="container">
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px">
        <h2>Laporan Saya</h2>
        <a href="{{ route('reports.create') }}" class="btn-primary">+ Buat Laporan</a>
    </div>

    <div class="panel">
        @forelse ($reports as $report)
            <div style="padding:12px 0; border-bottom:1px solid #f3f4f6">
                <strong>{{ $report->judul }}</strong>
                <p class="subtitle" style="margin:2px 0 0">
                    {{ $report->school->nama ?? '-' }} ·
                    {{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d M Y') }} ·
                    <em>{{ $report->status }}</em>
                </p>
            </div>
        @empty
            <p class="empty">Belum ada laporan.</p>
        @endforelse
    </div>
</main>
@endsection