@php
    $ocultarNavbar = true;
    $ocultarMenu = true;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/promocionForm.css') }}">
@endsection

@extends('layouts.app')

@section('content')
    <form action="{{ route('promociones.update', $promocion->Id_Promocion) }}" method="POST">
        @csrf
        @method('PUT')
        <fieldset>
            <div class="container">
                <h2>Editar promoción</h2>
                
                <div class="row mb-3">
                    <label class="form-label">Categoría</label>
                    <select class="form-select" name="Id_Categoria" id="categoria" disabled>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->Id_Categoria }}" {{ $promocion->producto->Id_Categoria == $categoria->Id_Categoria ? 'selected' : '' }}>
                                {{ $categoria->Nombre_Categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row mb-3">
                    <label class="form-label">Clasificación</label>
                    <select class="form-select" name="Id_Clasificacion" id="clasificacion" disabled>
                        <option value="">Seleccione una clasificación</option>
                        @foreach($clasificaciones as $clasificacion)
                            <option value="{{ $clasificacion->Id_Clasificacion }}" {{ $promocion->producto->Id_Clasificacion == $clasificacion->Id_Clasificacion ? 'selected' : '' }}>
                                {{ $clasificacion->Nombre_Clasificacion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Producto</label>
                    <select class="form-select" name="Id_Producto" id="producto" disabled>
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->Id_Producto }}" {{ $promocion->Id_Producto == $producto->Id_Producto ? 'selected' : '' }}>
                                {{ $producto->Nombre_Producto }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tipo de Promoción</label>
                    <select name="Id_Tipo_Promocion" id="tipo_promocion" class="form-select" required>
                        <option value="">Seleccione...</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->Id_Tipo_Promocion }}" {{ $promocion->Id_Tipo_Promocion == $tipo->Id_Tipo_Promocion ? 'selected' : '' }}>
                                {{ $tipo->Tipo_Promocion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3" id="campo_descuento" style="display: {{ $promocion->Id_Tipo_Promocion == 2 ? 'block' : 'none' }};">
                    <label>Descuento (%)</label>
                    <input type="number" name="Descuento" id="descuento" class="form-control" min="0" max="100" value="{{ $promocion->Descuento }}">
                </div>

                <div class="mb-3">
                    <label>Fecha Inicio</label>
                    <input type="date" name="Fecha_Inicio" class="form-control" required value="{{ $promocion->Fecha_Inicio }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Fecha Fin</label>
                    <input type="date" name="Fecha_Fin" class="form-control" required value="{{ $promocion->Fecha_Fin }}">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-light">Actualizar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection