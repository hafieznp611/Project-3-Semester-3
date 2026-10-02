<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Activity Manager</title>
</head>
<body>
    <div style="max-width: 700px; margin: 1rem auto; padding: 0 1rem;">

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div style="background:#fdecea; color:#b91c1c; padding:0.75rem 1rem; border-radius:6px; margin-bottom:1rem;">
                <strong>Periksa kembali input kamu:</strong>
                <ul style="margin:0.5rem 0 0 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </div>
</body>
</html>