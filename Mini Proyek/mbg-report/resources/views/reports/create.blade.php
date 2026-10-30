@extends('layouts.app')

@section('title', 'Buat Laporan')

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
    <h2>Buat Laporan</h2>
    <p class="subtitle">Isi detail kejadian dengan jelas dan lengkap.</p>

    <div class="panel">
        <form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label for="school_id">Sekolah</label>
                <select id="school_id" name="school_id"
                        class="@error('school_id') is-invalid @enderror" required>
                    <option value="">-- Pilih sekolah --</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}" @selected(old('school_id') == $school->id)>
                            {{ $school->nama }}
                        </option>
                    @endforeach
                </select>
                @error('school_id') <p class="err">{{ $message }}</p> @enderror
            </div>


            <div class="field">
                <label for="judul">Judul Laporan</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                       placeholder="Contoh: Makanan basi saat distribusi"
                       class="@error('judul') is-invalid @enderror" required>
                @error('judul') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="tanggal_kejadian">Tanggal Kejadian</label>
                <input type="date" id="tanggal_kejadian" name="tanggal_kejadian"
                       value="{{ old('tanggal_kejadian') }}" max="{{ date('Y-m-d') }}"
                       class="@error('tanggal_kejadian') is-invalid @enderror" required>
                @error('tanggal_kejadian') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="5"
                          placeholder="Ceritakan apa yang terjadi..."
                          class="@error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="foto">Foto Bukti (opsional)</label>
                <input type="file" id="foto" name="foto" accept="image/*"
                       class="@error('foto') is-invalid @enderror">
                @error('foto') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Kirim Laporan</button>
            </div>
        </form>
    </div>
</main>
@endsection