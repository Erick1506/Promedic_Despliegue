
@php
    $ocultarNavbar = true;
    $ocultarMenu = true;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/regente.css') }}">
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Regente</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Corrige los siguientes errores:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('regentes.update', $regente->Id_Regente) }}" method="POST">
        @csrf
        @method('PUT')

        @include('regentes.form') 
        
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Actualizar Regente</button>
            <a href="{{ route('regentes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
