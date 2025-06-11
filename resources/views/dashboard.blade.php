@extends('layouts.app')


@section('content')
    <h1>Listado de Productos</h1>

    @if ($productos->isEmpty())
        <p>No hay productos registrados.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Código de Barras</th>
                    <th>Marca</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $categoriaAnterior = null;
                    $clasificacionAnterior = null;
                @endphp

                {{-- Productos disponibles --}}
                @foreach($productos->where('estadoProducto.Tipo_Estado_Producto', '!=', 'No Disponible') as $producto)
                    @php
                        $clasificacion = $producto->clasificacion;
                        $categoriaActual = $clasificacion?->categoria?->Nombre_Categoria ?? 'Sin categoría';
                        $clasificacionActual = $clasificacion?->Nombre_Clasificacion ?? 'Sin clasificación';
                    @endphp

                    @if ($categoriaActual !== $categoriaAnterior)
                        <tr class="table-primary">
                            <td colspan="11"><strong>Categoría:</strong> {{ $categoriaActual }}</td>
                        </tr>
                        @php
                            $categoriaAnterior = $categoriaActual;
                            $clasificacionAnterior = null;
                        @endphp
                    @endif

                    @if ($clasificacionActual !== $clasificacionAnterior)
                        <tr class="table-secondary">
                            <td colspan="11"><strong>Clasificación:</strong> {{ $clasificacionActual }}</td>
                        </tr>
                        @php $clasificacionAnterior = $clasificacionActual; @endphp
                    @endif

                    <tr>
                        <td>{{ $producto->Id_Producto }}</td>
                        <td>{{ $producto->Nombre_Producto }}</td>
                        <td>{{ $producto->Descripcion_Producto }}</td>
                        <td>{{ $producto->Precio }} COP</td>
                        <td>{{ $producto->Cantidad_Stock }}</td>
                        <td>{{ $producto->Unidad }}</td>
                        <td>{{ $producto->Fecha_Vencimiento }}</td>
                        <td>{{ $producto->Codigo_Barras }}</td>
                        <td>{{ $producto->marca->Marca_Producto ?? 'Sin marca' }}</td>
                        <td>{{ $producto->estadoProducto->Tipo_Estado_Producto ?? 'Sin estado' }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-light">Editar</a>
                        </td>
                    </tr>
                @endforeach

                {{-- Productos NO disponibles --}}
                @php
                    $categoriaAnterior = null;
                    $clasificacionAnterior = null;
                @endphp

                @if ($productos->where('estadoProducto.Tipo_Estado_Producto', 'No Disponible')->isNotEmpty())
                    <tr class="table-danger">
                        <td colspan="11"><strong>Productos No Disponibles</strong></td>
                    </tr>
                @endif

                @foreach($productos->where('estadoProducto.Tipo_Estado_Producto', 'No Disponible') as $producto)
                    @php
                        $categoriaActual = $producto->clasificacion->categoria->Nombre_Categoria;
                        $clasificacionActual = $producto->clasificacion->Nombre_Clasificacion;
                    @endphp

                    @if ($categoriaActual !== $categoriaAnterior)
                        <tr class="table-primary">
                            <td colspan="11"><strong>Categoría:</strong> {{ $categoriaActual }}</td>
                        </tr>
                        @php
                            $categoriaAnterior = $categoriaActual;
                            $clasificacionAnterior = null;
                        @endphp
                    @endif

                    @if ($clasificacionActual !== $clasificacionAnterior)
                        <tr class="table-secondary">
                            <td colspan="11"><strong>Clasificación:</strong> {{ $clasificacionActual }}</td>
                        </tr>
                        @php $clasificacionAnterior = $clasificacionActual; @endphp
                    @endif

                    <tr>
                        <td>{{ $producto->Id_Producto }}</td>
                        <td>{{ $producto->Nombre_Producto }}</td>
                        <td>{{ $producto->Descripcion_Producto }}</td>
                        <td>{{ $producto->Precio }} COP</td>
                        <td>{{ $producto->Cantidad_Stock }}</td>
                        <td>{{ $producto->Unidad }}</td>
                        <td>{{ $producto->Fecha_Vencimiento }}</td>
                        <td>{{ $producto->Codigo_Barras }}</td>
                        <td>{{ $producto->marca->Marca_Producto ?? 'Sin marca' }}</td>
                        <td>{{ $producto->estadoProducto->Tipo_Estado_Producto ?? 'Sin estado' }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-light">Editar</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endif
    <!-- Botón flotante para abrir modal -->
    <button type="button" class="btn btn-primary position-fixed bottom-0 end-0 m-3" data-bs-toggle="modal"
        data-bs-target="#eliminarModal">
        Vender Producto
    </button>

    <!-- Modal de venta -->
   <!-- Modal de venta -->
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Venta de Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('productos.vender') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="idProducto" class="form-label">ID del Producto</label>
                        <input type="number" class="form-control" id="idProducto" name="idProducto" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="regenteProducto" class="form-label">Regente</label>
                        <select class="form-select" id="regenteProducto" name="id_regente" required>
                            <option value="">Seleccione un regente</option>
                            @foreach($regentes as $regente)
                                <option value="{{ $regente->Id_Regente }}">{{ $regente->Nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Procesar Venta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@if(session('error_js'))
    <script>
        alert("{{ session('error_js') }}");
    </script>
@endif


