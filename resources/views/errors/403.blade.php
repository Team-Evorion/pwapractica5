<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso denegado</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="guest-body">
<main class="container min-vh-100 d-flex align-items-center justify-content-center text-center text-white">
    <div><span class="display-1 fw-bold">403</span><h1 class="h2">Acceso denegado</h1><p class="text-white-50">Tu rol no tiene permiso para realizar esta acción.</p><a class="btn btn-light" href="{{ url()->previous() }}">Regresar</a></div>
</main>
</body>
</html>
