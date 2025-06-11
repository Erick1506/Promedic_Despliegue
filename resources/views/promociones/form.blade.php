<fieldset>
    <div class="container">
        <h2>{{ isset($promocion) ? 'Editar promoción' : 'Crear nueva promoción' }}</h2>
        <div class="row mb-3">
            <label class="form-label">Categoría</label>
            <select class="form-select" name="Id_Categoria" id="categoria" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->Id_Categoria }}" {{ isset($promocion) && $promocion->Id_Categoria == $categoria->Id_Categoria ? 'selected' : '' }}>
                        {{ $categoria->Nombre_Categoria }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="row mb-3">
            <label class="form-label">Clasificación</label>
            <select class="form-select" name="Id_Clasificacion" id="clasificacion" required>
                <option value="">Seleccione una clasificación</option>
                @foreach($clasificaciones as $clasificacion)
                    <option value="{{ $clasificacion->Id_Clasificacion }}" {{ isset($promocion) && $promocion->Id_Clasificacion == $clasificacion->Id_Clasificacion ? 'selected' : '' }}>
                        {{ $clasificacion->Nombre_Clasificacion }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Producto</label>
            <select class="form-select" name="Id_Producto" id="producto" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->Id_Producto }}" {{ isset($promocion) && $promocion->Id_Producto == $producto->Id_Producto ? 'selected' : '' }}>
                        {{ $producto->Nombre_Producto }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipo de Promoción</label>
            <select name="Id_Tipo_Promocion" id="tipo_promocion" class="form-select" onchange="actualizarDescuento()" required>
                <option value="">Seleccione...</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->Id_Tipo_Promocion }}" {{ isset($promocion) && $promocion->Id_Tipo_Promocion == $tipo->Id_Tipo_Promocion ? 'selected' : '' }}>
                        {{ $tipo->Tipo_Promocion }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3" id="campo_descuento" style="display: {{ isset($promocion) && $promocion->Id_Tipo_Promocion == 2 ? 'block' : 'none' }};">
            <label>Descuento (%)</label>
            <input type="number" name="Descuento" id="descuento" class="form-control" min="0" max="100" value="{{ isset($promocion) ? $promocion->Descuento : '' }}">
        </div>

        <div class="mb-3">
            <label>Fecha Inicio</label>
            <input type="date" name="Fecha_Inicio" class="form-control" required value="{{ isset($promocion) ? $promocion->Fecha_Inicio : '' }}">
        </div>

        <div class="mb-3">
            <label>Fecha Fin</label>
            <input type="date" name="Fecha_Fin" class="form-control" required value="{{ isset($promocion) ? $promocion->Fecha_Fin : '' }}">
        </div>
    </div>
</fieldset>
