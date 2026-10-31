@extends('layouts.app')

@section('title', 'Review Laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<main class="container">
    <h2>Review : {{ $report->judul }}</h2>
    <ul>Pelapor : {{ $report->user->nama_lengkap ?? '-' }}</ul>
    <p class="subtitle">
        {{ $report->school->nama ?? '-' }} · SPPG : {{ $report->school?->sppg?->nama ?? '-' }} · Penanggung Jawab : {{ $report->school?->sppg?->penanggung_jawab ?? '-' }}
    </p>
    

    <div class="panel">
        <p>{{ $report->deskripsi }}</p>
    </div>

    <div class="panel" style="margin-top:16px">
        <form method="POST" action="{{ route('reviews.update', $report) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="status">Status</label>
                <select id="status" name="status" class="@error('status') is-invalid @enderror">
                    @foreach (['Menunggu', 'Diproses', 'Selesai', 'Ditolak'] as $status)
                         <option value="{{ $status }}" @selected(old('status', $report->status) === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
                @error('status') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="catatan">Catatan (opsional)</label>
                <textarea id="catatan" name="catatan" rows="3">{{ old('catatan', $report->catatan_reviewer) }}</textarea>
            </div>

            <div class="form-actions">
                <a href="{{ route('reports.show', $report) }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Status</button>
            </div>
        </form>
    </div>
</main>
@endsection