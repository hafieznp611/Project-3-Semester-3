@extends('layout')
@section('judul', 'Daftar Barang')
@section('isi')
<h3>Daftar barang</h3>
@foreach ($barang as $b)
    <div class="baris">
        <div class="info">
            <strong>{{ $b->nama }}</strong><br>
            Rp {{ number_format($b->harga, 0, ',', '.') }}
            <span class="kecil">(stok {{ $b->stok }})</span>
        </div>
        <form method="post" action="{{ route('keranjang.tambah', $b->id) }}">
            @csrf
            <button type="submit">Masukkan ke keranjang</button>
        </form>
    </div>
@endforeach
@endsection