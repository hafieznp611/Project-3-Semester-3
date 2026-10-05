<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; margin-bottom: 1rem; }
        button { padding: 8px 14px; cursor: pointer; }
    </style>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>

    <h2>Selamat datang, {{ Auth::user()->nama_lengkap }}!</h2>
    <p>Halaman ini hanya bisa dibuka setelah login.</p>
    <p>Username: {{ Auth::user()->username }}</p>
</body>
</html>