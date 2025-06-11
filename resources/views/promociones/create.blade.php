<!-- resources/views/promociones/create.blade.php -->
@php
    $ocultarNavbar = true;
    $ocultarMenu = true;
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <h2>Promedic</h2>
        </a>
    </div>
</nav>

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/promocionForm.css') }}">
@endsection

@extends('layouts.app')


@section('content')

    <form action="{{ route('promociones.store') }}" method="POST">
        @csrf
        @include('promociones.form', ['categorias' => $categorias, 'tipos' => $tipos, 'productos' => $productos])
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-ligth">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>

        </div>
    </form>
    <script>

        const clasificaciones = @json($clasificaciones);
        const productos = @json($productos);

        document.addEventListener('DOMContentLoaded', () => {
            const categoriaSelect = document.querySelector('select[name="Id_Categoria"]');
            const clasificacionSelect = document.querySelector('select[name="Id_Clasificacion"]');
            const productoSelect = document.getElementById('producto');
            const tipoPromocionSelect = document.getElementById("tipo_promocion");
            const descuentoField = document.getElementById("descuento");

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

            function actualizarProductos() {
                const idClasificacion = clasificacionSelect.value;
                productoSelect.innerHTML = '<option value="">Seleccione un producto</option>';

                productos.forEach(producto => {
                    if (producto.Id_Clasificacion == idClasificacion) {
                        const option = document.createElement('option');
                        option.value = producto.Id_Producto;
                        option.textContent = producto.Nombre_Producto;
                        productoSelect.appendChild(option);
                    }
                });
            }

            categoriaSelect.addEventListener('change', () => {
                actualizarClasificaciones();
                productoSelect.innerHTML = '<option value="">Seleccione un producto</option>'; // Reiniciar productos
            });

            clasificacionSelect.addEventListener('change', () => {
                actualizarProductos();
            });

            tipoPromocionSelect.addEventListener('change', () => {
                descuentoField.value = tipoPromocionSelect.value == 1 ? 0 : '';
                descuentoField.readOnly = tipoPromocionSelect.value == 1;
            });
        });


        function actualizarDescuento() {
            const tipoPromocion = document.getElementById('tipo_promocion').value;
            const campoDescuento = document.getElementById('campo_descuento');

            // Si el tipo seleccionado es "2" (Descuento), mostramos el campo
            if (tipoPromocion == 2) {
                campoDescuento.style.display = 'block';
            } else {
                campoDescuento.style.display = 'none';
                document.getElementById('descuento').value = ''; // Limpia el campo
            }
        }

        // Llamamos a la función al cargar por si ya hay un valor seleccionado
        document.addEventListener('DOMContentLoaded', actualizarDescuento);
    </script>



@endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif