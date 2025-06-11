@extends('layouts.auth-style')

@section('content')
    <h2>Recuperar contraseña</h2>

    @if(session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email.check') }}">
        @csrf
        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" required>
        @error('correo') <div>{{ $message }}</div> @enderror

        <button type="submit">Enviar enlace</button>
        <a href="{{ route('login.form') }}">
            <button type="button">Cancelar</button>
        </a>
    </form>
@endsection