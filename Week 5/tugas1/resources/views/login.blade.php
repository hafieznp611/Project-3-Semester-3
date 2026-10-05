<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; background: #f3f4f6; display: flex; justify-content: center; padding-top: 80px; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; width: 320px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        input { width: 100%; padding: 8px; margin: 4px 0 14px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #1a57a0; color: #fff; border: 0; border-radius: 4px; cursor: pointer; }
        .error { background: #fde2e2; color: #c0392b; padding: 8px; border-radius: 4px; margin-bottom: 14px; }
        .success { background: #dcfce7; color: #166534; padding: 8px; border-radius: 4px; margin-bottom: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Login</h1>
        <p>Masuk untuk membuka dashboard</p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>