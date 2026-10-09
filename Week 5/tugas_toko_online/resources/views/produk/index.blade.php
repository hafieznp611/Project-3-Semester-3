@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')

<h3>Daftar barang</h3>



<div class="grid">
    @foreach ($products as $p)
        <div class="kartu">
            @if ($p->gambar && file_exists(public_path('images/products/' . $p->gambar)))
                <img class="gambar" src="{{ asset('images/products/' . $p->gambar) }}" alt="{{ $p->nama_barang }}">
            @else
                <div class="gambar kosong">tidak ada gambar</div>
            @endif

            <h4>{{ $p->nama_barang }}</h4>
            <div class="harga">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>

            @if ($p->stok > 0)
                <div class="kecil">Stok: {{ $p->stok }}</div>

                @auth
                    <form method="post" action="{{ route('keranjang.tambah', $p->id_barang) }}">
                        @csrf
                        <button type="submit">Masukkan ke keranjang</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="kecil">Login untuk membeli</a>
                @endauth
            @else
                <div class="habis">Stok habis</div>
                <button type="button" disabled>Tidak dapat dibeli</button>
            @endif
        </div>
    @endforeach
</div>
@endsection