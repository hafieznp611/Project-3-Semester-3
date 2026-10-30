@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

@section('content')
<div class="report-show">
    <div class="report-card">
        <h2 class="report-title">{{ $report->judul }}</h2>

        <ul class="report-meta">
            <li>{{ $report->school->nama ?? '-' }}</li>
            <li>{{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d M Y') }}</li>
            <li><span class="badge">{{ $report->status }}</span></li>
        </ul>

        <div class="report-section">
            <h3>Deskripsi</h3>
            <p>{{ $report->deskripsi ?? '-' }}</p>
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="back-link">Kembali ke halaman utama</a>
</div>
@endsection