<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Promedic</title>

    <!-- Bootstrap CSS + Icons (sin integrity para evitar mismatches) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @yield('css')

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/icon.png') }}">
</head>

<body>
    @if (!isset($ocultarNavbar) || !$ocultarNavbar)
        @include('layouts.navbar')
    @endif

    @if (!isset($ocultarMenu) || !$ocultarMenu)
        @include('layouts.menu')
    @endif


    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Bootstrap Bundle JS (Popper incluido) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tus scripts personalizados -->


    <!-- notifications.js y search.js se ejecutan tras parseo del DOM -->
    <script defer src="{{ asset('build/assets/js/notifications.js') }}"></script>
    <script defer src="{{ asset('build/assets/js/search.js') }}"></script>

    <!-- Push de scripts específicos de cada vista -->
    @stack('scripts')
    <script src="{{ asset('build/assets/js/menu.js') }}"></script>
    @yield('js')

</body>


</html>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif