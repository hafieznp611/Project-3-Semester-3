<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Toko Online</title>
    <style>
        body { font-family: sans-serif; max-width: 960px; margin: 0 auto; padding: 0 1rem 2rem; background: #fafafa; }
        header { display: flex; justify-content: space-between; align-items: center;
                 border-bottom: 2px solid #1a57a0; padding: 1rem 0; margin-bottom: 1rem; }
        header h2 { margin: 0; color: #1a57a0; }
        nav { display: flex; align-items: center; gap: 1rem; }
        nav a { text-decoration: none; color: #1a57a0; font-weight: bold; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 1rem; }
        .kartu { background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: .8rem; }
        .gambar { width: 100%; height: 140px; object-fit: cover; border-radius: 6px; background: #e8eef7; }
        .kosong { display: flex; align-items: center; justify-content: center; color: #889; font-size: 13px; }
        .harga { color: #1a7f37; font-weight: bold; }
        .kecil { color: #666; font-size: 13px; }
        .habis { color: #c0392b; font-weight: bold; }
        .err { background: #fce8e6; padding: .5rem; border-radius: 4px; color: #c0392b; }
        .ok  { background: #e6f4ea; padding: .5rem; border-radius: 4px; }
    </style>
</head>
<body>
    <header>
        <h2>Toko Online</h2>
        <nav>
            <a href="{{ route('products.index') }}">Beranda</a>

            @auth
                @can('use-cart')
                    <a href="{{ route('keranjang.tampilkan') }}">Keranjang ({{ array_sum(session('keranjang', [])) }})</a>
                    <a href="{{ route('pesanan.index') }}">Pesanan Saya</a>
                @endcan

                @can('manage-roles')
                    <a href="{{ route('admin.users.index') }}">Kelola Role</a>
                @endcan

                <span class="kecil">Halo, {{ Auth::user()->nama_lengkap }}</span>

                <form method="post" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth

            
        </nav>
        </header>

        @if (session('success'))
            <div class="ok">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="err">{{ session('error') }}</div>
        @endif

    <!-- <p>Status: {{ Auth::check() ? 'SUDAH login sebagai ' . Auth::user()->username : 'BELUM login' }}</p> -->

    @yield('content')
</body>
</html>