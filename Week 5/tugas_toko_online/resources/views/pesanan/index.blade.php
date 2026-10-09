@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<h3>Pesanan saya</h3>

@forelse ($orders as $o)
    <div class="kartu" style="margin-bottom:.5rem; display:flex; align-items:center; gap:1rem">
        <div style="flex:1">
            <strong>{{ $o->id_order }}</strong><br>
            <span class="kecil">{{ $o->tanggal_order->format('d-m-Y H:i') }}</span><br>
            Total: <span class="harga">Rp {{ number_format($o->total_harga, 0, ',', '.') }}</span>
        </div>
        <a href="{{ route('pesanan.show', $o->id_order) }}">Lihat detail</a>
    </div>
@empty
    <p>Anda belum punya pesanan.</p>
@endforelse
@endsection