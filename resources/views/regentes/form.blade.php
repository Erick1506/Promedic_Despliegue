<!-- resources/views/regente/form.blade.php -->

<div class="mb-3">
    <label for="nombre_regente">Nombre del Regente</label>
    <input type="text" name="Nombre" id="nombre_regente" class="form-control" placeholder="Nombre del Regente"
        value="{{ old('Nombre', $regente->Nombre ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="apellido_regente">Apellido del Regente</label>
    <input type="text" name="Apellido" id="apellido_regente" class="form-control" placeholder="Apellido del Regente"
        value="{{ old('Apellido', $regente->Apellido ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="dni_regente">DNI del Regente</label>
    <input type="number" name="DNI" id="dni_regente" class="form-control" placeholder="DNI del Regente"
        value="{{ old('DNI', $regente->DNI ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="fecha_contratacion_regente">Fecha de Contratación</label>
    <input type="date" name="Fecha_Contratacion" id="fecha_contratacion_regente" class="form-control"
        value="{{ old('Fecha_Contratacion', $regente->Fecha_Contratacion ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="licencia_regente">Licencia del Regente</label>
    <input type="text" name="Licencia" id="licencia_regente" class="form-control" placeholder="Licencia del Regente"
        value="{{ old('Licencia', $regente->Licencia ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="correo_regente">Correo del Regente</label>
    <input type="email" name="Correo" id="correo_regente" class="form-control" placeholder="Correo del Regente"
        value="{{ old('Correo', $regente->Correo ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="telefono_regente">Teléfono del Regente</label>
    <input type="number" name="Telefono" id="telefono_regente" class="form-control" placeholder="Teléfono del Regente"
        value="{{ old('Telefono', $regente->Telefono ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="turno_regente">Turno</label>
    <select name="Id_Turno" id="turno_regente" class="form-control" required>
        <option value="">Seleccione un Turno</option>
        @foreach($turnos as $turno)
            <option value="{{ $turno->Id_Turno }}" {{ old('Id_Turno', $regente->Id_Turno ?? '') == $turno->Id_Turno ? 'selected' : '' }}>
                {{ $turno->turno }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="contrasena_regente">Contraseña del Regente</label>
    <input type="password" name="Contraseña_Encriptada" id="contrasena_regente" class="form-control"
        placeholder="Contraseña del Regente" {{ isset($regente) ? '' : 'required' }}>
</div>

