<!DOCTYPE html>
<html lang="es">

@section('css')
    <!-- Cargar solo el archivo CSS necesario para esta vista -->
    <link rel="stylesheet" href="{{ asset('build/assets/css/login.css') }}">
@endsection

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="{{ asset('build/assets/css/login.css') }}">
    <script src="https://kit.fontawesome.com/a2dd6045c4.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/icon.png') }}">
</head>

<body>
    <section>
        <div class="contenedor">
            <div class="formulario">
                <form method="POST" action="{{ route('login.process') }}">
                    @csrf {{-- Token CSRF para seguridad --}}
                    <h2>Iniciar Sesión</h2>

                    {{-- Mensaje de error dinámico --}}
                    @if ($errors->any())
                        <p id="mensajeError" class="error">
                            {{ $errors->first() }}
                        </p>
                    @endif

                    <div class="input-contenedor">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" id="email" name="correo" required>
                        <label for="email">Correo</label>
                    </div>

                    <div class="input-contenedor">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="contraseña" required>
                        <label for="password">Contraseña</label>
                    </div>

                    <button type="submit">Acceder</button>

                    <div class="registrar">
                        <p>¿Olvidaste tu <a href="{{ route('password.email.form') }}">contraseña?</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>