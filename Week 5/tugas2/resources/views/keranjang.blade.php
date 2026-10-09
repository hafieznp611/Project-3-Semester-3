@extends('layout')
@section('judul', 'Keranjang')
@section('isi')
<h3>Keranjang belanja</h3>
<p><a href="{{ route('index') }}">Kembali ke daftar barang</a></p>

@forelse ($items as $i)
    <div class="baris">
        <div class="info">
            <strong>{{ $i['nama'] }}</strong><br>
            Rp {{ number_format($i['harga'], 0, ',', '.') }} x {{ $i['jumlah'] }}
            = Rp {{ number_format($i['subtotal'], 0, ',', '.') }}
        </div>
        <form method="post" action="{{ route('keranjang.ubah', $i['id']) }}">
            @csrf <input type="hidden" name="aksi" value="minus"><button>-</button>
        </form>
        <strong>{{ $i['jumlah'] }}</strong>
        <form method="post" action="{{ route('keranjang.ubah', $i['id']) }}">
            @csrf <input type="hidden" name="aksi" value="plus"><button>+</button>
        </form>
        <form method="post" action="{{ route('keranjang.hapus', $i['id']) }}">
            @csrf <button>hapus</button>
        </form>
    </div>
@empty
    <p>Keranjang kosong.</p>
@endforelse

@if (count($items))
    <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
    <form method="post" action="{{ route('keranjang.kosongkan') }}">
        @csrf <button>Kosongkan keranjang</button>
    </form>
@endif
@endsection