<!-- resources/views/proveedores/form.blade.php -->
<div class="mb-3">
    <label for="nombre_proveedor">Nombre del Proveedor</label>
    <input type="text" name="Nombre_Proveedor" id="nombre_proveedor" placeholder="Nombre del Proveedor" value="{{ old('Nombre_Proveedor', $proveedor->Nombre_Proveedor ?? '') }}" required class="form-control">
</div>
<div class="mb-3">
    <label for="direccion_proveedor">Dirección del Proveedor</label>
    <input type="text" name="Direccion_Proveedor" id="direccion_proveedor" placeholder="Dirección del Proveedor" value="{{ old('Direccion_Proveedor', $proveedor->Direccion_Proveedor ?? '') }}" required class="form-control">
</div>
<div class="mb-3">
    <label for="correo_proveedor">Correo del Proveedor</label>
    <input type="email" name="Correo" id="correo_proveedor" placeholder="Correo del Proveedor" value="{{ old('Correo', $proveedor->Correo ?? '') }}" required class="form-control">
</div>
<div class="mb-3">
    <label for="telefono_proveedor">Teléfono del Proveedor</label>
    <input type="text" name="Telefono" id="telefono_proveedor" placeholder="Teléfono del Proveedor" value="{{ old('Telefono', $proveedor->Telefono ?? '') }}" required class="form-control">
</div>