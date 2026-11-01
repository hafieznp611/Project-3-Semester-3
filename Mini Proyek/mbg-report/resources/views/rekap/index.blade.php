@extends('layouts.app')

@section('title', 'Rekap Laporan')

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
    <h2>Rekap Laporan</h2>
    <p class="subtitle">Ringkasan kondisi laporan berdasarkan data yang tersimpan.</p>

    {{-- Ringkasan --}}
    <div class="cards">
        <div class="card">
            <p class="card-label">Total Laporan</p>
            <p class="card-value">{{ $ringkasan['total'] }}</p>
        </div>
        <div class="card">
            <p class="card-label">Menunggu</p>
            <p class="card-value">{{ $ringkasan['menunggu'] }}</p>
        </div>
        <div class="card">
            <p class="card-label">Diproses</p>
            <p class="card-value">{{ $ringkasan['diproses'] }}</p>
        </div>
        <div class="card">
            <p class="card-label">Selesai</p>
            <p class="card-value">{{ $ringkasan['selesai'] }}</p>
        </div>
    </div>

    {{-- Tabel rekap per sekolah --}}
    <div class="panel" style="overflow-x:auto">
        <h3>Rekap per Sekolah</h3>

        <table style="width:100%; border-collapse:collapse; font-size:14px; margin-top:10px">
            <thead>
                <tr style="text-align:left; border-bottom:2px solid #e5e7eb">
                    <th style="padding:10px 8px">Sekolah</th>
                    <th style="padding:10px 8px">Kecamatan</th>
                    <th style="padding:10px 8px; text-align:center">Total</th>
                    <th style="padding:10px 8px; text-align:center">Menunggu</th>
                    <th style="padding:10px 8px; text-align:center">Diproses</th>
                    <th style="padding:10px 8px; text-align:center">Selesai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perSekolah as $row)
                    <tr style="border-bottom:1px solid #f3f4f6">
                        <td style="padding:10px 8px"><strong>{{ $row->nama }}</strong></td>
                        <td style="padding:10px 8px">{{ $row->kecamatan }}</td>
                        <td style="padding:10px 8px; text-align:center"><strong>{{ $row->total }}</strong></td>
                        <td style="padding:10px 8px; text-align:center">{{ $row->menunggu }}</td>
                        <td style="padding:10px 8px; text-align:center">{{ $row->diproses }}</td>
                        <td style="padding:10px 8px; text-align:center">{{ $row->selesai }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty" style="padding:16px 8px">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="my-pagination" style="margin-top:14px">
            {{ $perSekolah->links() }}
        </div>
    </div>
</main>
@endsection