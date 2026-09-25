@extends('layouts.app')

@section('content')
    <h1>{{ $activity->title }}</h1>
    <p>Tanggal: {{ $activity->activity_date->format('d M Y') }}</p>
    <p>Kategori: {{ $activity->category }}</p>
    <p>Status: {{ $activity->status }}</p>
    <p>{{ $activity->description }}</p>

    <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning">Edit Kegiatan</a>

    <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus Kegiatan</button>
    </form>

    <br><br>
    <a href="{{ route('activities.index') }}">Kembali ke daftar</a>
@endsection