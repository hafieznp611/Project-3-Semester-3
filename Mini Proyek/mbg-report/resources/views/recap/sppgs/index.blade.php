@extends('layouts.app')

@section('title', 'Daftar SPPG')

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
        <h2>Daftar SPPG</h2>
        <a href="{{ route('sppgs.create') }}" class="btn-primary">+ Tambah SPPG</a>
    </div>

    <div class="panel" style="overflow-x:auto">
        <table style="width:100%; border-collapse:collapse; font-size:14px">
            <thead>
                <tr style="text-align:left; border-bottom:2px solid #e5e7eb">
                    <th style="padding:10px 8px">Nama</th>
                    <th style="padding:10px 8px">Penanggung Jawab</th>
                    <th style="padding:10px 8px">Kontak</th>
                    <th style="padding:10px 8px">Distribusi</th>
                    <th style="padding:10px 8px"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sppgs as $sppg)
                    <tr style="border-bottom:1px solid #f3f4f6">
                        <td style="padding:10px 8px"><strong>{{ $sppg->nama }}</strong><br>
                            <small style="color:#6b7280">{{ $sppg->alamat ?? '-' }}</small></td>
                        <td style="padding:10px 8px">{{ $sppg->penanggung_jawab ?? '-' }}</td>
                        <td style="padding:10px 8px">{{ $sppg->kontak_penanggung_jawab ?? '-' }}</td>
                        <td style="padding:10px 8px">{{ $sppg->schools_count }}</td>
                        <td style="padding:10px 8px">
                            <a href="{{ route('sppgs.edit', $sppg) }}" class="link-back">Ubah</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty" style="padding:16px 8px">Belum ada SPPG.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="my-pagination">
        {{ $sppgs->links() }}
    </div>
</main>
@endsection