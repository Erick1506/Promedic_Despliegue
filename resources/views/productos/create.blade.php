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

        {{-- Toggler general --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



        {{-- Menú principal --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('proveedores.index') ? 'active' : '' }}"
                        href="{{ route('proveedores.index') }}">Gestión de proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('promociones.index') ? 'active' : '' }}"
                        href="{{ route('promociones.index') }}">Gestión de promociones</a>
                </li>
        </div>
    </div>
</nav>

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/producto.create.css') }}">
@endsection

@section('content')
    <fieldset class="border p-4 rounded shadow-sm bg-light">
        <legend class="text-primary text-center mb-4">Agregar Producto</legend>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    @endforeach
                </ul>
                </d <li>{{ $error }}</li>
                iv>
        @endif

            <form action="{{ route('productos.store') }}" method="POST">
                @csrf

                @include('productos.form')
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                </div>
            </form>
            @include('productos.modales-producto')

@endsection


        @push('scripts')
            <script>

                // Filtrar clasificaciones por categorias 
                const clasificaciones = @json($clasificaciones);

                document.addEventListener('DOMContentLoaded', () => {
                    const categoriaSelect = document.querySelector('select[name="Id_Categoria"]');
                    const clasificacionSelect = document.querySelector('select[name="Id_Clasificacion"]');

                    function actualizarClasificaciones() {
                        const idCategoria = categoriaSelect.value;
                        clasificacionSelect.innerHTML = '<option value="">Seleccione una clasificación</option>';

                        clasificaciones.forEach(clasificacion => {
                            if (clasificacion.Id_Categoria == idCategoria) {
                                const option = document.createElement('option');
                                option.value = clasificacion.Id_Clasificacion;
                                option.textContent = clasificacion.Nombre_Clasificacion;
                                clasificacionSelect.appendChild(option);
                            }
                        });
                    }

                    categoriaSelect.addEventListener('change', actualizarClasificaciones);

                    if (categoriaSelect.value) {
                        actualizarClasificaciones();
                    }
                });
            </script>
        @endpush

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const estadoProductoSelect = document.querySelector('select[name="Id_Estado_Producto"]');
                    const promocionFields = document.getElementById('promocionFields');
                    const tipoPromocionSelect = document.getElementById('tipoPromocion');
                    const descuentoField = document.getElementById('descuentoField');

                    function togglePromocionFields() {
                        if (estadoProductoSelect.value == '3') { // ID 3 = Promoción
                            promocionFields.style.display = 'block';
                        } else {
                            promocionFields.style.display = 'none';
                            tipoPromocionSelect.value = '';
                            descuentoField.style.display = 'none';
                        }
                    }

                    function toggleDescuentoField() {
                        // Aquí asumimos que el tipo de promoción "descuento" tiene el texto literal "descuento"
                        const selectedText = tipoPromocionSelect.options[tipoPromocionSelect.selectedIndex]?.textContent.toLowerCase();
                        if (selectedText === 'descuento') {
                            descuentoField.style.display = 'block';
                        } else {
                            descuentoField.style.display = 'none';
                        }
                    }

                    // Eventos
                    estadoProductoSelect.addEventListener('change', togglePromocionFields);
                    tipoPromocionSelect.addEventListener('change', toggleDescuentoField);

                    // Ejecutar en carga inicial si hay valores preseleccionados
                    togglePromocionFields();
                    toggleDescuentoField();
                });
            </script>
        @endpush

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif