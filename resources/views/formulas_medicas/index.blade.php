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
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('recetas.create') ? 'active' : '' }}"
                        href="{{ route('recetas.create') }}">Agregar Formula Medica</a>
                </li>
            </ul>
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control"
                    placeholder="Buscar por nombre o identificación...">
            </div>
        </div>
    </div>
</nav>


@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/formulas.css') }}">
@endsection
@section('content')
    <div class="main-content">
        <div class="outer-container">
            <div class="inner-container">

                <h2>Lista de Fórmulas Médicas</h2>

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table mt-3 table-bordered table-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Paciente</th>
                            <th>Identificación del Paciente</th>
                            <th>Fecha de Inserción</th>
                            <th>Administrador</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formulas as $formula)
                            <tr>
                                <td>{{ $formula->Id_Formula }}</td>
                                <td>{{ $formula->Nombre_Paciente }}</td>
                                <td>{{ $formula->Identificacion_Paciente }}</td>
                                <td>{{ $formula->Fecha_Insercion }}</td>
                                <td>{{ $formula->Id_Administrador }}</td>
                                <td><img src="{{ asset($formula->Imagen) }}" alt="Imagen" width="100" style="cursor: pointer;"
                                        onclick="openImageModal(this.src)"></td>
                                <td>
                                    <a href="{{ route('recetas.edit', $formula->Id_Formula) }}" class="btn btn-light">Editar</a>
                                    <form action="{{ route('recetas.destroy', $formula->Id_Formula) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta fórmula?');">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<div id="imageOverlay" class="image-overlay" onclick="closeImageModal()">
    <img id="modalImage" src="" alt="Imagen Ampliada">
</div>

<script>
    function openImageModal(src) {
        const overlay = document.getElementById('imageOverlay');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = src;
        overlay.classList.add('show');
    }

    function closeImageModal() {
        const overlay = document.getElementById('imageOverlay');
        overlay.classList.remove('show');
        setTimeout(() => {
            document.getElementById('modalImage').src = '';
        }, 300);
    }

    // Evita cerrar si se hace clic sobre la imagen
    document.getElementById('modalImage').addEventListener('click', function (event) {
        event.stopPropagation();
    });
</script>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('table tbody tr');

        rows.forEach(row => {
            // Obtener texto de columnas Nombre y Identificación
            let nombre = row.cells[1].textContent.toLowerCase();
            let identificacion = row.cells[2].textContent.toLowerCase();

            // Mostrar fila si alguna columna contiene el texto buscado
            if (nombre.includes(filter) || identificacion.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>