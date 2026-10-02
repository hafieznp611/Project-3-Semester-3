@forelse ($activities as $activity)
    <p>{{ $activity->title }}</p>
    
    <form method="POST" action="{{ route('activities.restore', $activity) }}">
        @csrf
        @method('PATCH')
        <button type="submit">Restore</button>
        
    </form>

    
@empty
    <p>Tidak ada kegiatan yang terhapus.</p>

@endforelse

<a href="{{ route('activities.index') }}">Kembali ke daftar</a>