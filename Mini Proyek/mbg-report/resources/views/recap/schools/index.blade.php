@extends('layouts.app')

@section('title', 'Daftar Sekolah')

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
        <h2>Daftar Sekolah</h2>
        <a href="{{ route('schools.create') }}" class="btn-primary">+ Tambah Sekolah</a>
    </div>

    <div class="panel" style="overflow-x:auto">
        <table style="width:100%; border-collapse:collapse; font-size:14px">
            <thead>
                <tr style="text-align:left; border-bottom:2px solid #e5e7eb">
                    <th style="padding:10px 8px">Sekolah</th>
                    <th style="padding:10px 8px">Kecamatan</th>
                    <th style="padding:10px 8px">SPPG</th>
                    <th style="padding:10px 8px"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schools as $school)
                    <tr style="border-bottom:1px solid #f3f4f6">
                        <td style="padding:10px 8px"><strong>{{ $school->nama }}</strong></td>
                        <td style="padding:10px 8px">{{ $school->kecamatan }}</td>
                        <td style="padding:10px 8px">{{ $school->sppg?->nama ?? '-' }}</td>
                        <td style="padding:10px 8px">
                            <a href="{{ route('schools.edit', $school) }}" class="link-back">Ubah</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty" style="padding:16px 8px">Belum ada sekolah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="my-pagination">
        {{ $schools->links() }}
    </div>
</main>
@endsection