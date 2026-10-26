<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - MBG Report</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: #f3f6f4;
            color: #1f2937;
            min-height: 100vh;
        }
    </style>

    @stack('styles')
</head>
<body>
    @yield('content')
</body>
</html>