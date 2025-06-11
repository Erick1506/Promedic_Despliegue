@extends('layouts.app')
@php
    $ocultarNavbar = true;
    $ocultarMenu = true;
@endphp



<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <h2>Promedic</h2>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboard') }}">Inicio</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


@section('content')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/informes.css') }}">
@endsection

<div class="container p-4 contenedor-reporte shadow">
    <h1 class="text-center text-primary mb-4">
        Reporte General - <strong class="text-uppercase">PROMEDIC</strong>
    </h1>

    {{-- Bloque: Transacciones --}}
    <div class="mb-4">
        <button class="btn btn-outline-primary w-100 d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#tablaTransacciones">
            <span><i class="bi bi-box-arrow-in-down me-2"></i> Transacciones del Inventario</span>
            <i class="bi bi-chevron-down toggle-icon"></i>
        </button>
        <div class="collapse mt-2" id="tablaTransacciones">
            <div class="table-responsive shadow rounded">
                <table class="table table-sm table-striped table-bordered">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Proveedor</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($transacciones as $t)
                            <tr>
                                <td>{{ $t->Fecha_Transaccion }}</td>
                                <td>{{ $t->tipoTransaccion->Tipo_Transaccion ?? 'N/A' }}</td>
                                <td>{{ $t->producto->Nombre_Producto ?? 'N/A' }}</td>
                                <td>{{ $t->producto->marca->Marca_Producto ?? 'Sin Marca' }}</td>
                                <td>{{ $t->producto->proveedor->Nombre_Proveedor ?? 'Sin Proveedor' }}</td>
                                <td>{{ $t->Cantidad }}</td>
                                <td>${{ number_format($t->producto->Precio ?? 0, 2) }}</td>
                                <td>${{ number_format(($t->Cantidad * ($t->producto->Precio ?? 0)), 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Bloque: Productos --}}
    <div class="mb-4">
        <button class="btn btn-outline-primary w-100 d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#tablaProductos">
            <span><i class="bi bi-bag-check me-2"></i> Productos Actuales</span>
            <i class="bi bi-chevron-down toggle-icon"></i>
        </button>
        <div class="collapse mt-2" id="tablaProductos">
            <div class="table-responsive shadow rounded">
                <table class="table table-sm table-striped table-bordered">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Proveedor</th>
                            <th>Marca</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($productos as $p)
                            <tr>
                                <td>{{ $p->Id_Producto }}</td>
                                <td>{{ $p->Nombre_Producto }}</td>
                                <td>${{ number_format($p->Precio, 2) }}</td>
                                <td>{{ $p->EstadoProducto->Tipo_Estado_Producto ?? 'Sin estado' }}</td>
                                <td>{{ $p->proveedor->Nombre_Proveedor ?? 'Sin proveedor' }}</td>
                                <td>{{ $p->marca->Marca_Producto ?? 'Sin marca' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Bloque: Comprobantes --}}
    <div class="mb-4">
        <button class="btn btn-outline-primary w-100 d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#tablaComprobantes">
            <span><i class="bi bi-receipt me-2"></i> Ventas (Comprobantes)</span>
            <i class="bi bi-chevron-down toggle-icon"></i>
        </button>
        <div class="collapse mt-2" id="tablaComprobantes">
            <div class="table-responsive shadow rounded">
                <table class="table table-sm table-striped table-bordered">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Regente</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha Venta</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($comprobantes as $c)
                            <tr>
                                <td>{{ $c->Id_Comprobante }}</td>
                                <td>{{ $c->regente->Nombre ?? 'Sin Regente' }}</td>
                                <td>{{ $c->producto->Nombre_Producto ?? 'Producto no disponible' }}</td>
                                <td>{{ $c->Cantidad }}</td>
                                <td>{{ $c->Fecha_Venta }}</td>
                                <td>${{ number_format($c->Total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGenerarReporte">
        <i class="bi bi-file-earmark-plus me-2"></i> Generar Reporte
    </button>
</div>

@include('informes.form') 

   
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const boton = document.getElementById('btnMostrarFormulario');
        const formulario = document.getElementById('contenedorFormulario');

        if (boton && formulario) {
            boton.addEventListener('click', function () {
                formulario.style.display = 'block';
                boton.style.display = 'none';
            });
        }
    });
</script>
@endsection

