<div class="col-md-4">
    <label for="categoria" class="form-label fw-bold">Selecciona una categoría:</label>
    <select id="categoria" class="form-select" onchange="window.location.href='?categoria_id=' + this.value">
        <option value="">-- Seleccione --</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->Id_Categoria }}" {{ request('categoria_id') == $categoria->Id_Categoria ? 'selected' : '' }}>
                {{ $categoria->Nombre_Categoria }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-4">
    <label for="clasificacion" class="form-label fw-bold">Selecciona una clasificación:</label>
    <select id="clasificacion" class="form-select" onchange="window.location.href='?categoria_id={{ request('categoria_id') }}&clasificacion_id=' + this.value">
        <option value="">-- Seleccione --</option>
        @if($clasificaciones)
            @foreach($clasificaciones as $clasificacion)
                <option value="{{ $clasificacion->Id_Clasificacion }}" {{ request('clasificacion_id') == $clasificacion->Id_Clasificacion ? 'selected' : '' }}>
                    {{ $clasificacion->Nombre_Clasificacion }}
                </option>
            @endforeach
        @endif
    </select>
</div>

<div class="col-md-4">
    <form method="GET" action="">
        <label for="producto" class="form-label fw-bold">Selecciona un producto:</label>
        <select name="producto" id="producto" class="form-select" onchange="this.form.submit()">
            <option value="">-- Selecciona --</option>
            @foreach($productos as $producto)
                <option value="{{ $producto->Id_Producto }}" {{ request('producto') == $producto->Id_Producto ? 'selected' : '' }}>
                    {{ $producto->Nombre_Producto }}
                </option>
            @endforeach
        </select>
    </form>
</div>