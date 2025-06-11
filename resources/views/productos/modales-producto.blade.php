
<!-- Modal Nueva Categoría -->
<div class="modal fade" id="modalNuevaCategoria" tabindex="-1" aria-labelledby="modalNuevaCategoriaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="formNuevaCategoria" method="POST" action="{{ route('categorias.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Nombre de la nueva categoría</label>
                    <input type="text" class="form-control" name="Nombre_Categoria" required>
                </div>
                <div class="modal-body">
                    <label class="form-label">Descripción de la nueva categoría</label>
                    <input type="text" class="form-control" name="Descripcion_Categoria">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Nueva Clasificación -->
<div class="modal fade" id="modalNuevaClasificacion" tabindex="-1" aria-labelledby="modalNuevaClasificacionLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="formNuevaClasificacion" method="POST" action="{{ route('clasificaciones.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Clasificación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                
                 <div class="modal-body">
                <label class="form-label">Categoría</label>
                <select class="form-select" name="Id_Categoria" id="categoria_clasificacion" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->Id_Categoria }}">{{ $categoria->Nombre_Categoria }}</option>
                    @endforeach
                </select>
                </div>
                <div class="modal-body">
                    <label class="form-label">Nombre de la nueva clasificación</label>
                    <input type="text" class="form-control" name="Nombre_Clasificacion" required>
                </div>
                <div class="modal-body">
                    <label class="form-label">Descripción de la nueva clasificación</label>
                    <input type="text" class="form-control" name="Descripcion_Clasificacion">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="guardarClasificacion">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Nueva Marca -->
<div class="modal fade" id="modalNuevaMarca" tabindex="-1" aria-labelledby="modalNuevaMarcaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="formNuevaMarca" method="POST" action="{{ route('marcas.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Nombre de la nueva marca</label>
                    <input type="text" class="form-control" name="Marca_Producto" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>