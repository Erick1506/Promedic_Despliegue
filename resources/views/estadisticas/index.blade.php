@php
    $ocultarNavbar = true;
@endphp

{{-- NAVBAR PRINCIPAL --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        {{-- Marca / Título --}}
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <h2 class="m-0">Promedic</h2>
        </a>

        {{-- Menú principal --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('informes.inventario') ? 'active' : '' }}"
                        href="{{ route('informes.inventario') }}">Reporte de inventario</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/estadisticas.css') }}">
@endsection

@section('content')
    <div class="container my-4">
        <h1 class="mb-4 text-center panel-title">Panel de Estadísticas</h1>

        <!-- Filtros de categoría, clasificación y producto -->
        <div class="row mb-4 filtros-form">
            @include('estadisticas.partials.filtros', [
                'categorias' => $categorias,
                'clasificaciones' => $clasificaciones,
                'productos' => $productos
            ])
        </div>

        <!-- Contenedor bonito para las gráficas -->
        <div class="estadisticas-container">
            <div class="row">
                @include('estadisticas.partials.graficas')
            </div>

            <p class="text-center text-muted mt-4">
                *La información mostrada se actualiza en tiempo real según los datos del sistema.
            </p>
        </div>
    </div>

    <!-- Datos para las gráficas -->
    <input type="hidden" id="ventasLabels" value='{{ json_encode($labels) }}'>
    <input type="hidden" id="ventasData" value='{{ json_encode($ventasData) }}'>
    <input type="hidden" id="productosVendidosLabels"
        value='{{ json_encode($productos_vendidos->pluck('Nombre_Producto')) }}'>
    <input type="hidden" id="productosVendidosData"
        value='{{ json_encode($productos_vendidos->pluck('Total_Ventas')) }}'>
    <input type="hidden" id="productosMenosVendidosLabels"
        value='{{ json_encode($productos_menos_vendidos->pluck('Nombre_Producto')) }}'>
    <input type="hidden" id="productosMenosVendidosData"
        value='{{ json_encode($productos_menos_vendidos->pluck('Total_Ventas')) }}'>

    @php
        $productosClasificacion = $productos_clasificacion instanceof \Illuminate\Support\Collection
            ? $productos_clasificacion
            : collect($productos_clasificacion);
    @endphp

    <input type="hidden" id="productosClasificacionLabels"
        value='{{ json_encode($productosClasificacion->pluck('Nombre_Producto') ?? []) }}'>
    <input type="hidden" id="productosClasificacionData"
        value='{{ json_encode($productosClasificacion->pluck('Cantidad_Stock') ?? []) }}'>

    <!-- Script para inicializar las gráficas con Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('build/assets/js/estadisticas.js') }}"></script>
@endsection
