@extends('layouts.app')

@section('title', $school->exists ? 'Ubah Sekolah' : 'Tambah Sekolah')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<header class="topbar">
    <div class="topbar-brand">🍱 MBG Report</div>
    <div class="topbar-user">
        <a href="{{ route('schools.index') }}" class="link-back">← Daftar Sekolah</a>
    </div>
</header>

<main class="container">
    <h2>{{ $school->exists ? 'Ubah Sekolah' : 'Tambah Sekolah' }}</h2>

    <div class="panel">
        <form method="POST"
              action="{{ $school->exists ? route('schools.update', $school) : route('schools.store') }}">
            @csrf
            @if ($school->exists) @method('PUT') @endif

            <div class="field">
                <label for="nama">Nama Sekolah</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $school->nama) }}"
                       placeholder="Contoh: SDN 3 Gegerkalong"
                       class="@error('nama') is-invalid @enderror" required>
                @error('nama') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="kecamatan">Kecamatan</label>
                <input type="text" id="kecamatan" name="kecamatan"
                       value="{{ old('kecamatan', $school->kecamatan) }}"
                       placeholder="Contoh: Sukasari"
                       class="@error('kecamatan') is-invalid @enderror" required>
                @error('kecamatan') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="sppg_id">SPPG Pemasok</label>
                <select id="sppg_id" name="sppg_id" class="@error('sppg_id') is-invalid @enderror">
                    <option value="">-- Belum ditentukan --</option>
                    @foreach ($sppgs as $sppg)
                        <option value="{{ $sppg->id }}"
                            @selected(old('sppg_id', $school->sppg_id) == $sppg->id)>
                            {{ $sppg->nama }}
                        </option>
                    @endforeach
                </select>
                @error('sppg_id') <p class="err">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('schools.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</main>
@endsection