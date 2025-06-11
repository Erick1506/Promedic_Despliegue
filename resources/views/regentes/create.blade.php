<!-- resources/views/regentes/create.blade.php -->

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
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/css/regente.css') }}">
@endsection

@section('content')
    <div class="container mt-5">
        <h2>Agregar regente</h2>

        <form action="{{ route('regentes.store') }}" method="POST">
            @csrf
            @include('regentes.form') <!-- Incluir el formulario -->
            <button type="submit" class="btn btn-ligth">Agregar Regente</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>

        </form>
    </div>


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