@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">

@endpush

@section('content')
<div class="report-show">
    <div class="report-card">
        <h2 class="report-title">{{ $report->judul }}</h2>
        <ul>Pelapor : {{ $report->user->nama_lengkap ?? '-' }}</ul>
        <ul class="report-meta">
            <li>SPPG: {{ $report->school?->sppg?->nama ?? '-' }}</li>
            <li>{{ $report->school->nama ?? '-' }}</li>
            <li>{{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d M Y') }}</li>
            <li><span class="badge">{{ $report->status }}</span></li>
        </ul>
        @if ($report->catatan_reviewer)
            <div class="report-section">
                <h3>Catatan Reviewer</h3>
                <p>{{ $report->catatan_reviewer }}</p>
            </div>
        @endif
        <a href="{{ route('dashboard') }}" class="back-link">Kembali ke halaman utama</a>

        @if (auth()->id() === $report->user_id && $report->status === 'Menunggu')
            <a href="{{ route('reports.edit', $report) }}" class="back-link">Edit</a>
        @endif

        @can('reviewing')
            <a href="{{ route('reviews.edit', $report) }}" class="back-link">Ubah Status</a>
        @endcan

        
</div>
@endsection