@php
    $ocultarNavbar = true;
    $ocultarMenu = true;
@endphp

@extends('layouts.app')
 <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><h2>Promedic</h2></a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('promociones.create') }}">Crear una promoción</a>
                    </li>
                </ul>
                <form class="d-flex" method="GET" action="{{ route('promociones.index') }}">
                    <input class="form-control me-2" type="search" placeholder="Buscar por tipo de promoción"
                        name="tipo_promocion" value="{{ request('tipo_promocion') }}">
                    <button class="btn btn-custom" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Promociones</h1>

    <!-- Mensajes de estado -->
    @if(session('msg'))
        <div class="alert alert-success text-center">
            {{ session('msg') }}
        </div>
    @endif

   

    <div class="row promociones-container" id="promocionesContainer">
        @if($promociones->isNotEmpty())
            @foreach($promociones as $promocion)
                <div class="col-md-4 mb-4 promocion-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Producto: {{ $promocion->producto->Nombre_Producto }}</h5>
                            <p class="card-text"><strong>Precio:</strong> ${{ number_format($promocion->producto->Precio, 2) }}</p>
                            <p class="card-text"><strong>Descripción:</strong> {{ $promocion->producto->Descripcion_Producto }}</p>
                            <p class="card-text"><strong>Cantidad en Stock:</strong> {{ $promocion->producto->Cantidad_Stock }}</p>
                            <hr>
                            <p class="card-text"><strong>Tipo de Promoción:</strong> {{ $promocion->tipoPromocion->Tipo_Promocion }}</p>
                            <p class="card-text"><strong>Fecha de Inicio:</strong> {{ $promocion->Fecha_Inicio }}</p>
                            <p class="card-text"><strong>Fecha de Fin:</strong> {{ $promocion->Fecha_Fin }}</p>

                            @if($promocion->tipoPromocion->Tipo_Promocion == "Descuento" && $promocion->Descuento)
                                <p class="card-text"><strong>Descuento:</strong> {{ $promocion->Descuento }}%</p>
                            @endif

                            <a href="{{ route('promociones.edit', $promocion->Id_Promocion) }}" class="btn btn-light btn-sm">Editar</a>
                            <form action="{{ route('promociones.destroy', $promocion->Id_Promocion) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta promoción?');">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">No hay promociones disponibles.</p>
        @endif
    </div>
</div>
@endsection