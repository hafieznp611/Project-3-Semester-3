blade
@extends('layouts.app')

@section('title', 'Ubah Laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<header class="topbar">
    <div class="topbar-brand">🍱 MBG Report</div>
    <div class="topbar-user">
        <a href="{{ route('reports.show', $report) }}" class="link-back">← Detail Laporan</a>
    </div>
</header>

<main class="container">
    <h2>Ubah Laporan</h2>

    <div class="panel">
        <form method="POST" action="{{ route('reports.update', $report) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="school_id">Sekolah</label>
                <select id="school_id" name="school_id"
                        class="@error('school_id') is-invalid @enderror" required>
                    <option value="">-- Pilih sekolah --</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}"
                            @selected(old('school_id', $report->school_id) == $school->id)>
                            {{ $school->nama }}
                        </option>
                    @endforeach
                </select>
                @error('school_id') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="judul">Judul Laporan</label>
                <input type="text" id="judul" name="judul"
                       value="{{ old('judul', $report->judul) }}"
                       class="@error('judul') is-invalid @enderror" required>
                @error('judul') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="tanggal_kejadian">Tanggal Kejadian</label>
                <input type="date" id="tanggal_kejadian" name="tanggal_kejadian"
                       value="{{ old('tanggal_kejadian', \Carbon\Carbon::parse($report->tanggal_kejadian)->format('Y-m-d')) }}"
                       max="{{ date('Y-m-d') }}"
                       class="@error('tanggal_kejadian') is-invalid @enderror" required>
                @error('tanggal_kejadian') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="5"
                          class="@error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $report->deskripsi) }}</textarea>
                @error('deskripsi') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="foto">Foto Bukti (opsional)</label>
                @if ($report->foto)
                    <p><img src="{{ asset('storage/' . $report->foto) }}" alt="Foto saat ini"
                            style="max-width:200px; border-radius:8px"></p>
                    <small>Pilih file baru hanya jika ingin mengganti foto.</small>
                @endif
                <input type="file" id="foto" name="foto" accept="image/*"
                       class="@error('foto') is-invalid @enderror">
                @error('foto') <p class="err">{{ $message }}</p> @enderror
            </div>

            @can('reviewing')
                <div class="field">
                    <label for="foto">Status</label>
                    <select id="status" name="status" class="@error('status') is-invalid @enderror">
                        @foreach (['Menunggu', 'Diproses', 'Selesai', 'Ditolak'] as $status)
                            <option
                                value="{{ $status }}"
                                @selected(old('status', $activity->status ?? 'Planned') === $status)
                            >
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endcan

            <div class="form-actions">
                <a href="{{ route('reports.show', $report) }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>
@endsection