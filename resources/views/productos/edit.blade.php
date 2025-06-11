@php
    $ocultarNavbar = true;
    $ocultarMenu = true;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/producto.edit.css') }}">
@endsection

@extends('layouts.app')

@section('content')
    <form action="{{ route('productos.update', $producto->Id_Producto) }}" method="POST">
        @csrf
        @method('PUT')
        
        <fieldset>
            <div class="container">
                <h2>Editar Producto</h2>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="Nombre_Producto" class="form-control" value="{{ $producto->Nombre_Producto }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="Descripcion_Producto" class="form-control" value="{{ $producto->Descripcion_Producto }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Precio</label>
                        <input type="number" name="Precio" class="form-control" step="0.01" value="{{ $producto->Precio }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cantidad</label>
                        <input type="number" name="Cantidad_Stock" class="form-control" value="{{ $producto->Cantidad_Stock }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Cantidad Mínima</label>
                        <input type="number" name="Cantidad_Minima" class="form-control" value="{{ $producto->Cantidad_Minima }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cantidad Máxima</label>
                        <input type="number" name="Cantidad_Maxima" class="form-control" value="{{ $producto->Cantidad_Maxima }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Costo de Adquisición</label>
                        <input type="number" name="Costo_Adquisicion" class="form-control" value="{{ $producto->Costo_Adquisicion }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Peso</label>
                        <input type="text" name="Peso" class="form-control" value="{{ $producto->Peso }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Fecha de Vencimiento</label>
                        <input type="date" name="Fecha_Vencimiento" class="form-control" value="{{ $producto->Fecha_Vencimiento }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Código de Barras</label>
                        <input type="text" name="Codigo_Barras" class="form-control" value="{{ $producto->Codigo_Barras }}" required>
                    </div>
                </div>

                <div class="row mb-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Marca</label>
                        <select class="form-select" name="Id_Marca" required>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->Id_Marca }}" {{ $producto->Id_Marca == $marca->Id_Marca ? 'selected' : '' }}>
                                    {{ $marca->Marca_Producto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="col-md-6">
                        <label class="form-label">Estado del Producto</label>
                        <select class="form-select" name="Id_Estado_Producto">
                            @foreach($estados as $estado)
                                <option value="{{ $estado->Id_Estado_Producto }}" {{ $producto->Id_Estado_Producto == $estado->Id_Estado_Producto ? 'selected' : '' }}>
                                    {{ $estado->Tipo_Estado_Producto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" name="Id_Categoria" required>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->Id_Categoria }}" {{ $producto->Id_Categoria == $categoria->Id_Categoria ? 'selected' : '' }}>
                                    {{ $categoria->Nombre_Categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Clasificación</label>
                        <select class="form-select" name="Id_Clasificacion" required>
                            @foreach($clasificaciones as $clasificacion)
                                <option value="{{ $clasificacion->Id_Clasificacion }}" {{ $producto->Id_Clasificacion == $clasificacion->Id_Clasificacion ? 'selected' : '' }}>
                                    {{ $clasificacion->Nombre_Clasificacion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Proveedor</label>
                        <select class="form-select" name="Id_Proveedor" required>
                            @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->Id_Proveedor }}" {{ $producto->Id_Proveedor == $proveedor->Id_Proveedor ? 'selected' : '' }}>
                                    {{ $proveedor->Nombre_Proveedor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-light">Actualizar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                </div>
            </div>
        </fieldset>
    </form>
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