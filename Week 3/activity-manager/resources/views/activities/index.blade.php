{{-- resources/views/activities/index.blade.php --}}
{{-- resources/views/activities/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Daftar Kegiatan</h1>

    <form method="GET" action="{{ route('activities.index') }}" class="filter-bar">
        <label for="status">Status</label>
        <select name="status" id="status" onchange="this.form.submit()">
            <option value="">Semua</option>
            @foreach (['Planned', 'Ongoing', 'Done'] as $status)
                <option value="{{ $status }}" @selected($selectedStatus === $status)>
                    {{ $status }}
                </option>
            @endforeach
        </select>

        <label for="category">Kategori</label>
        <input
            type="text"
            name="category"
            id="category"
            value="{{ $selectedCategory }}"
            placeholder="mis. Workshop"
        >

        <button type="submit">Terapkan</button>
        <a href="{{ route('activities.index') }}">Reset</a>
    </form>

    @forelse ($activities as $activity)
        <article class="card">
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>
            <p>{{ $activity->activity_date->format('d M Y') }}</p>
            <p>Status: {{ $activity->status }}</p>
        </article>
    @empty
        <p>Belum ada kegiatan yang cocok dengan filter.</p>
    @endforelse

    <a href="{{ route('activities.create') }}" class="btn btn-primary">Tambah Kegiatan Baru</a>
@endsection

