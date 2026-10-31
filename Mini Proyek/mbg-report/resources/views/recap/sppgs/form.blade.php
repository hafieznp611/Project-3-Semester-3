@extends('layouts.app')

@section('title', $sppg->exists ? 'Ubah SPPG' : 'Tambah SPPG')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<header class="topbar">
    <div class="topbar-brand">🍱 MBG Report</div>
    <div class="topbar-user">
        <a href="{{ route('sppgs.index') }}" class="link-back">← Daftar SPPG</a>
    </div>
</header>

<main class="container">
    <h2>{{ $sppg->exists ? 'Ubah SPPG' : 'Tambah SPPG' }}</h2>

    <div class="panel">
        <form method="POST"
              action="{{ $sppg->exists ? route('sppgs.update', $sppg) : route('sppgs.store') }}">
            @csrf
            @if ($sppg->exists) @method('PUT') @endif

            <div class="field">
                <label for="nama">Nama SPPG</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $sppg->nama) }}"
                       placeholder="Contoh: SPPG Bandung Gegerkalong"
                       class="@error('nama') is-invalid @enderror" required>
                @error('nama') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $sppg->alamat) }}"
                       class="@error('alamat') is-invalid @enderror">
                @error('alamat') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="penanggung_jawab">Penanggung Jawab</label>
                <input type="text" id="penanggung_jawab" name="penanggung_jawab"
                       value="{{ old('penanggung_jawab', $sppg->penanggung_jawab) }}"
                       class="@error('penanggung_jawab') is-invalid @enderror">
                @error('penanggung_jawab') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="kontak_penanggung_jawab">Kontak (No. HP)</label>
                <input type="text" id="kontak_penanggung_jawab" name="kontak_penanggung_jawab"
                       value="{{ old('kontak_penanggung_jawab', $sppg->kontak_penanggung_jawab) }}"
                       placeholder="08xxxxxxxxxx"
                       class="@error('kontak_penanggung_jawab') is-invalid @enderror">
                @error('kontak_penanggung_jawab') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('sppgs.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</main>
@endsection