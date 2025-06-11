<!-- resources/views/regentes/index.blade.php -->

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
    <link rel="stylesheet" href="{{ asset('build/assets/css/regente.css') }}">
@endsection


@section('content')
    <div class="container mt-5">
        <h2>Gestión de Regentes</h2>

        <!-- Botón para agregar un nuevo regente -->
        <a href="{{ route('regentes.create') }}" class="btn btn-success mb-3">Agregar regentes</a>

        <!-- Formulario para Buscar Regente -->
        <form action="{{ route('regentes.index') }}" method="GET" class="mt-3">
            <div class="input-group">
                <input type="text" name="buscar_regente" placeholder="Buscar por nombre" class="form-control">
                <button type="submit" class="btn btn-secondary">Buscar Regente</button>
            </div>
        </form>

        <!-- Tabla de Regentes -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Fecha Contratación</th>
                    <th>Licencia</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Turno</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($regentes as $regente)
                    <tr>
                        <td>{{ $regente->Id_Regente }}</td>
                        <td>{{ $regente->Nombre }}</td>
                        <td>{{ $regente->Apellido }}</td>
                        <td>{{ $regente->DNI }}</td>
                        <td>{{ $regente->Fecha_Contratacion }}</td>
                        <td>{{ $regente->Licencia }}</td>
                        <td>{{ $regente->Correo }}</td>
                        <td>{{ $regente->Telefono }}</td>
                        <td>{{ $regente->turno ? $regente->turno->turno : 'Sin turno asignado' }}</td>
                        <td>
                            <a href="{{ route('regentes.edit', $regente->Id_Regente) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('regentes.destroy', $regente->Id_Regente) }}" method="POST"
                                style="display:inline;">
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
    </div>
@endsection