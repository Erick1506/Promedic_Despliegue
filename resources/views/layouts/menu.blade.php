<nav class="navbar navbar-light" style="background-color: #ffffff;">
  <div class="container-fluid">
    <!-- Botón toggle para offcanvas -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
      aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end" id="offcanvasNavbar" tabindex="-1" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasNavbarLabel">Categorías y Clasificaciones</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
      </div>

      <div class="offcanvas-body">
        <!-- Buscador -->
        <input id="search-bar" type="text" class="form-control mb-3"
          placeholder="Buscar categorías o clasificaciones...">

        {{-- Mensaje tipo toast --}}
        <div id="toast-message" class="toast align-items-center text-bg-primary border-0 position-fixed top-0 end-0 m-3"
          role="alert" aria-live="assertive" aria-atomic="true" style="display:none; z-index:1055;">
          <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" aria-label="Close"
              onclick="hideToast()"></button>
          </div>
        </div>

        {{-- Listado de categorías y clasificaciones --}}
        @forelse($categorias as $categoria)
        <div class="category-card mb-4">
          <h6 class="text-primary d-flex align-items-center justify-content-between">
          <span>{{ $categoria->Nombre_Categoria }}</span>
          <button class="btn btn-sm btn-link p-0" onclick="toggleDescription(this)">
            <i class="bi bi-three-dots-vertical"></i>
          </button>
          </h6>

          <div class="border rounded p-2 mb-2 descripcion" style="display:none;">
          <p class="desc-text">{{ $categoria->Descripcion_Categoria }}</p>
          <div class="d-flex justify-content-end gap-2 align-items-center">
            <button class="btn btn-sm btn-outline-primary btn-edit" data-id="{{ $categoria->Id_Categoria }}"
            onclick="startEdit(this, 'categoria', '{{ $categoria->Id_Categoria }}')">
            <i class="bi bi-pencil"></i> Editar
            </button>
            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST"
            onsubmit="return confirm('¿Eliminar categoría?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">
              <i class="bi bi-trash"></i>
            </button>
            </form>
          </div>
          </div>

          {{-- Clasificaciones asociadas --}}
          @if ($categoria->clasificaciones && $categoria->clasificaciones->isNotEmpty())
          @foreach($categoria->clasificaciones as $clasificacion)
        <div class="border rounded bg-light p-2 ms-3 mb-2 classification-card">
        <div class="d-flex align-items-center justify-content-between">
          <strong>{{ $clasificacion->Nombre_Clasificacion }}</strong>
          <button class="btn btn-sm btn-link p-0" onclick="toggleDescription(this)">
          <i class="bi bi-three-dots-vertical"></i>
          </button>
        </div>
        <div class="descripcion" style="display:none;">
          <p class="desc-text mb-1">{{ $clasificacion->Descripcion_Clasificacion }}</p>
          <div class="d-flex justify-content-end gap-2">
          <button class="btn btn-sm btn-outline-success btn-edit" data-id="{{ $clasificacion->Id_Clasificacion }}"
          onclick="startEdit(this, 'clasificacion', '{{ $clasificacion->Id_Clasificacion }}')">
          <i class="bi bi-pencil"></i> Editar
          </button>
          <form action="{{ route('clasificaciones.destroy', $clasificacion) }}" method="POST"
          onsubmit="return confirm('¿Eliminar clasificación?')">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-outline-danger">
          <i class="bi bi-trash"></i>
          </button>
          </form>
          </div>
        </div>
        </div>
        @endforeach
        @else
        <p class="ms-3 text-muted">— Sin clasificaciones —</p>
        @endif
        </div>
    @empty
      <p class="text-muted">No hay categorías definidas.</p>
    @endforelse
      </div>
    </div>
  </div>
</nav>