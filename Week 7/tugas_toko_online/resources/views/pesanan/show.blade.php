@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<h3>Detail pesanan {{ $order->id_order }}</h3>
<p class="kecil">
    Tanggal: {{ $order->tanggal_order->format('d-m-Y H:i') }}<br>
    Alamat pengiriman: {{ $order->alamat_pengiriman }}
</p>

<table style="width:100%; border-collapse:collapse; background:#fff">
    <thead>
        <tr style="background:#e8eef7; text-align:left">
            <th style="padding:.5rem">Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->details as $d)
            <tr style="border-top:1px solid #ddd">
                <td style="padding:.5rem">{{ $d->product->nama_barang }}</td>
                <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $d->jumlah_beli }}</td>
                <td>Rp {{ number_format($d->harga_satuan * $d->jumlah_beli, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h3>
<p><a href="{{ route('pesanan.index') }}">Kembali ke daftar pesanan</a></p>
@endsection