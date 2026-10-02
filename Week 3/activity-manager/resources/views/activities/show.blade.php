@extends('layouts.app')

@if($activity->poster_path)
    <img src="{{ Storage::url($activity->poster_path) }}" alt="Poster {{ $activity->title }}" style="max-width: 100%; border-radius: 8px; margin-bottom: 1rem;">
@endif

@section('content')
    <h1>{{ $activity->title }}</h1>
    <p>
        <strong>Kode:</strong>
        {{ $activity->code }}
    </p>
    <p>
        <strong>Kategori:</strong>
        {{ $activity->category->name }}
    </p>
    <p>
        <strong>Selesai:</strong>
        {{ $activity->end_at->format('d M Y') }}
    </p>
    <p>
        <strong>Lokasi:</strong>
        {{ $activity->location }}
    </p>
    <p>
        <strong>Kapasitas:</strong>
        {{ $activity->capacity }} peserta
    </p>
    <p>
        <strong>Status:</strong>{{ $activity->status }}</p>

    <p><strong>Deskripsi:</strong>{{ $activity->description }}</p>
    <br>

    <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning">Edit Kegiatan</a>

    <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus Kegiatan</button>
    </form>

    <br><br>
    <a href="{{ route('activities.index') }}" class="btn btn-primary">Kembali ke daftar</a>

    
    @if ($activity->status === 'Published')
        <h2>Daftar Kegiatan Ini</h2>
        <form method="POST" action="{{ route('activities.registrations.store', $activity) }}">
            @csrf
            <label for="participant_name">Nama</label>
            <input id="participant_name" name="participant_name" value="{{ old('participant_name') }}">
            @error('participant_name') <p class="error">{{ $message }}</p> @enderror

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">

            <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
    @endif
@endsection
