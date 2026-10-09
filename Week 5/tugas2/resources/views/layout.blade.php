<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - Toko Alat Tulis</title>
    <style>
        body { font-family: sans-serif; max-width: 640px; margin: 2rem auto; padding: 0 1rem; }
        header { display: flex; justify-content: space-between; align-items: center;
                 border-bottom: 2px solid #1a57a0; padding-bottom: .5rem; }
        header a { text-decoration: none; color: #1a57a0; font-weight: bold; }
        .baris { display: flex; align-items: center; gap: 1rem; padding: .6rem 0; border-bottom: 1px solid #eee; }
        .gambar { width: 48px; height: 48px; background: #e8eef7; border-radius: 6px;
                  display: flex; align-items: center; justify-content: center; }
        .info { flex: 1; }
        .kecil { color: #666; font-size: 13px; }
        button { cursor: pointer; padding: 4px 10px; }
        form { display: inline; }
        .ok { background: #e6f4ea; padding: .5rem; margin-top: 1rem; }
        .err { background: #fce8e6; padding: .5rem; margin-top: 1rem; }
    </style>
</head>
<body>
    <header>
        <h2>Toko Alat Tulis</h2>
        <a href="{{ route('keranjang') }}">Keranjang ({{ $jumlahItem }})</a>
    </header>
    @if (session('sukses')) <div class="ok">{{ session('sukses') }}</div> @endif
    @if (session('error')) <div class="err">{{ session('error') }}</div> @endif
    @yield('isi')
</body>
</html>