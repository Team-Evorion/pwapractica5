<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión · PWA Práctica 5</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="guest-body">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        @yield('content')
    </main>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
