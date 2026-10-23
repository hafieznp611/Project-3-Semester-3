@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<h3>Keranjang belanja</h3>

@forelse ($items as $i)
    <div class="kartu" style="margin-bottom:.5rem; display:flex; align-items:center; gap:1rem">
        <div style="flex:1">
            <strong>{{ $i['name'] }}</strong><br>
            Rp {{ number_format($i['harga'], 0, ',', '.') }} x {{ $i['jumlah'] }}
            = Rp {{ number_format($i['subtotal'], 0, ',', '.') }}
        </div>

        <form method="post" action="{{ route('keranjang.ubah', $i['id']) }}">
            @csrf
            <input type="hidden" name="aksi" value="minus">
            <button type="submit">-</button>
        </form>

        <strong>{{ $i['jumlah'] }}</strong>

        <form method="post" action="{{ route('keranjang.ubah', $i['id']) }}">
            @csrf
            <input type="hidden" name="aksi" value="plus">
            <button type="submit">+</button>
        </form>
    </div>
@empty
    <p>Keranjang kosong.</p>
@endforelse

@if (count($items))
    <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
@endif

@if (count($items))

    <form method="post" action="{{ route('pesanan.checkout') }}">
        @csrf
        <p>
            <label>Alamat pengiriman</label><br>
            <textarea name="alamat" rows="3" cols="40" required>{{ old('alamat', Auth::user()->alamat) }}</textarea>
        </p>
        @error('alamat')
            <p class="err">{{ $message }}</p>
        @enderror
        <button type="submit">Checkout</button>
    </form>
@endif
@endsection