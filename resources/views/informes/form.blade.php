<!-- Modal -->
<div class="modal fade" id="modalGenerarReporte" tabindex="-1" aria-labelledby="modalGenerarReporteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalGenerarReporteLabel">Generar Informe</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/generar-informe') }}" method="POST" id="formGenerarInforme">
          @csrf
          <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio:</label>
            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
          </div>
          <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha Fin:</label>
            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" required>
          </div>
          <div class="mb-3">
            <label for="tipo_informe" class="form-label">Tipo de Informe:</label>
            <select class="form-select" name="tipo_informe" id="tipo_informe" required>
              <option value="">Seleccione</option>
              <option value="producto">Por Producto</option>
              <option value="categoria">Por Categoría</option>
              <option value="clasificacion">Por Clasificación</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría:</label>
            <select class="form-select" name="categoria_id" id="categoria_id">
              <option value="">Seleccione una categoría</option>
              @foreach($categorias as $c)
                <option value="{{ $c->Id_Categoria }}">{{ $c->Nombre_Categoria }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="clasificacion_id" class="form-label">Clasificación:</label>
            <select class="form-select" name="clasificacion_id" id="clasificacion_id" disabled>
              <option value="">Seleccione una clasificación</option>
              @foreach($clasificaciones as $cl)
                <option value="{{ $cl->Id_Clasificacion }}" data-categoria="{{ $cl->Id_Categoria }}">{{ $cl->Nombre_Clasificacion }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="producto_id" class="form-label">Producto:</label>
            <select class="form-select" name="producto_id" id="producto_id" disabled>
              <option value="">Seleccione un producto</option>
              @foreach($productos as $p)
                <option value="{{ $p->Id_Producto }}" data-clasificacion="{{ $p->Id_Clasificacion }}">{{ $p->Nombre_Producto }}</option>
              @endforeach
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Generar PDF</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@section('js')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const categoriaSelect = document.getElementById('categoria_id');
    const clasificacionSelect = document.getElementById('clasificacion_id');
    const productoSelect = document.getElementById('producto_id');

    categoriaSelect.addEventListener('change', function () {
      const categoriaId = this.value;
      clasificacionSelect.disabled = !categoriaId;
      productoSelect.disabled = true;
      clasificacionSelect.value = '';
      productoSelect.value = '';

      Array.from(clasificacionSelect.options).forEach(option => {
        if (option.value === '') return;
        option.style.display = option.getAttribute('data-categoria') === categoriaId ? 'block' : 'none';
      });
    });

    clasificacionSelect.addEventListener('change', function () {
      const clasificacionId = this.value;
      productoSelect.disabled = !clasificacionId;
      productoSelect.value = '';

      Array.from(productoSelect.options).forEach(option => {
        if (option.value === '') return;
        option.style.display = option.getAttribute('data-clasificacion') === clasificacionId ? 'block' : 'none';
      });
    });
  });
</script>
@endsection
