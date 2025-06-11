
@extends('layouts.auth-style')

@section('content')
<h2>Restablecer contraseña</h2>

@if($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('password.reset.save') }}">
    @csrf
    <input type="hidden" name="correo" value="{{ $correo }}">
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="tipo" value="{{ $tipo }}">

    <label for="password">Nueva contraseña:</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">Confirmar contraseña:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Cambiar contraseña</button>
</form>
@endsection
