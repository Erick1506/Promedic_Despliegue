<!-- resources/views/proveedores/index.blade.php -->

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

@extends('layouts.app')

    

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/proveedor.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <h2>Gestión de Proveedores</h2>

    <!-- Botón para agregar un nuevo proveedor -->
    <a href="{{ route('proveedores.create') }}" class="btn btn-success mb-3">Agregar Proveedor</a>

    <!-- Formulario para Buscar Proveedor -->
    <form action="{{ route('proveedores.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="buscar_proveedor" placeholder="Buscar por nombre" class="form-control">
            <button type="submit" class="btn btn-secondary">Buscar</button>
        </div>
    </form>

    <!-- Tabla de Proveedores -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->Id_Proveedor }}</td>
                    <td>{{ $proveedor->Nombre_Proveedor }}</td>
                    <td>{{ $proveedor->Direccion_Proveedor }}</td>
                    <td>{{ $proveedor->Correo }}</td>
                    <td>{{ $proveedor->Telefono }}</td>
                    <td>
                        <a href="{{ route('proveedores.edit', $proveedor->Id_Proveedor) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('proveedores.destroy', $proveedor->Id_Proveedor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection