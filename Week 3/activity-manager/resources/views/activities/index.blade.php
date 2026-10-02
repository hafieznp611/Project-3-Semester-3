{{-- resources/views/activities/index.blade.php --}} 

@extends('layouts.app') 
@section('content') 

    <h1>Daftar Kegiatan</h1> 

    <a href="{{ route('activities.create') }}" class="btn btn-primary"> Tambah Kegiatan Baru </a> 
    <a href="{{ route('activities.trash') }}">Lihat Kegiatan Terhapus</a>

    <form method="GET" action="{{ route('activities.index') }}" class="filter-bar"> 
        
        <label for="search">Search</label> 
        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari judul atau kode..." > 
        
        <label for="status">Status</label>
            <select name="status" id="status"> 
                <option value="">Semua Status</option>
            
                    @foreach (['Draft', 'Published', 'Completed'] as $status) 

                        <option value="{{ $status }}" {{ $selectedStatus === $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
            
                    @endforeach
             </select>  

        <label for="category">Kategori</label> 
        <input type="text" name="category" id="category" value="{{ $selectedCategory }}" placeholder="mis. Workshop" >
        
        <label for="sort">Urutkan</label>
        <select name="sort" id="sort">
            <option value="terbaru" {{ $selectedSort === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
            <option value="terlama" {{ $selectedSort === 'terlama' ? 'selected' : '' }}>Terlama</option>
        </select>
        
        <button type="submit">Terapkan</button> 
        <a href="{{ route('activities.index') }}"> Reset </a> 


    </form> 
    
    @forelse ($activities as $activity) 
        <article class="card"> 
            <h2> 
                <a href="{{ route('activities.show', $activity) }}"> 
                    {{ $activity->title }} 
                </a> 
            </h2> 
            <p>Kode: {{ $activity->code }}</p> 
            <p>Kategori: {{ $activity->category->name }}</p> 
            <p>Status: {{ $activity->status }}</p> 
            <p> {{ $activity->start_at->format('d M Y') }} </p> 
        </article> 
        
    @empty 
        <p> Belum ada kegiatan yang cocok dengan filter. </p>
    @endforelse
{{ $activities->links() }}
    
@endsection