@php
    $ocultarNavbar = true;
    $ocultarMenu = true;
@endphp

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/proveedor.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <h2>Editar Proveedor</h2>

    <form action="{{ route('proveedores.update', $proveedor->Id_Proveedor) }}" method="POST" class="edit-form">
        @csrf
        @method('PUT')

        <div class="container-input">
            <label for="Nombre_Proveedor">Nombre</label>
            <input type="text" name="Nombre_Proveedor" id="Nombre_Proveedor" value="{{ old('Nombre_Proveedor', $proveedor->Nombre_Proveedor) }}" required>
        </div>

        <br>

        <div class="container-input">
            <label for="Direccion_Proveedor">Dirección</label>
            <input type="text" name="Direccion_Proveedor" id="Direccion_Proveedor" value="{{ old('Direccion_Proveedor', $proveedor->Direccion_Proveedor) }}">
        </div>

        <br>


        <div class="container-input">
            <label for="Correo">Correo</label>
            <input type="email" name="Correo" id="Correo" value="{{ old('Correo', $proveedor->Correo) }}">
        </div>

        <br>
        
        <div class="container-input">
            <label for="Telefono">Teléfono</label>
            <input type="text" name="Telefono" id="Telefono" value="{{ old('Telefono', $proveedor->Telefono) }}">
        </div>

        <br>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
            <br>
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

