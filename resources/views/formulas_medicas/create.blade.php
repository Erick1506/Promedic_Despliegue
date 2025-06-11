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
    <link rel="stylesheet" href="{{ asset('build/assets/css/formulas.css') }}">
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recetas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('formulas_medicas.form')

    </form>

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