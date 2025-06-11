@php
    $ocultarNavbar = true;
    $ocultarMenu = true;

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
</nav>
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/formulas.css') }}">
@endsection

@section('content')
    <div class="main-content">
        <div class="outer-container">
            <div class="inner-container">
                <h2>Editar Fórmula Médica</h2>

                <form action="{{ route('recetas.update', $formula->Id_Formula) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="Nombre_Paciente" class="form-label">Nombre del Paciente</label>
                        <input type="text" name="Nombre_Paciente" class="form-control"
                            value="{{ old('Nombre_Paciente', $formula->Nombre_Paciente) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Identificacion_Paciente" class="form-label">Identificación del Paciente</label>
                        <input type="number" name="Identificacion_Paciente" class="form-control"
                            value="{{ old('Identificacion_Paciente', $formula->Identificacion_Paciente) }}">
                    </div>

                    <div class="mb-3">
                        <label for="Fecha_Insercion" class="form-label">Fecha de Inserción</label>
                        <input type="date" name="Fecha_Insercion" class="form-control"
                            value="{{ old('Fecha_Insercion', $formula->Fecha_Insercion) }}">
                    </div>

                    <input type="hidden" name="Id_Administrador" value="1">

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Cambiar Imagen</label>
                        <input type="file" name="imagen" class="form-control" accept="image/*">
                    </div>

                    @if ($formula->Imagen)
                        <div class="mb-3">
                            <label class="form-label">Imagen actual:</label><br>
                            <img src="{{ asset($formula->Imagen) }}" alt="Imagen fórmula médica"
                                style="max-width: 300px; height: auto; border-radius: 8px; border: 1px solid #ccc; padding: 5px;">
                        </div>
                    @endif

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary me-2">Actualizar</button>
                        <a href="{{ route('recetas.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection