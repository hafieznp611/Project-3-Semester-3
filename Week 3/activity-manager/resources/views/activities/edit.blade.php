@extends('layouts.app')

@section('content')
    <h1>Ubah Kegiatan</h1>

    <form method="POST" action="{{ route('activities.update', $activity) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('activities._form')
        <button  type="submit" class = "btn btn-primary" >Simpan Perubahan</button>
    </form>
@endsection