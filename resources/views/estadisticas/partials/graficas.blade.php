<!-- Gráfica de ventas semanales -->
<div class="col-md-6 mb-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-center fw-bold">Ventas Semanales</h5>
            <p class="card-text text-muted text-center">
                Muestra la cantidad vendida por semana del producto seleccionado, 
                correspondiente al mes actual. Si no seleccionas un producto, no se mostrará información.
            </p>
            <canvas id="ventasChart"></canvas>
        </div>
    </div>
</div>

<!-- Gráfica de productos más vendidos -->
<div class="col-md-6 mb-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-center fw-bold">Productos Más Vendidos</h5>
            <p class="card-text text-muted text-center">
                Lista de los 5 productos que han alcanzado mayores ventas totales en la base de datos.
            </p>
            <canvas id="productosVendidosChart"></canvas>
        </div>
    </div>
</div>

<!-- Gráfica de productos menos vendidos -->
<div class="col-md-6 mb-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-center fw-bold">Productos Menos Vendidos</h5>
            <p class="card-text text-muted text-center">
                Lista de los 5 productos con las ventas más bajas.
            </p>
            <canvas id="productosMenosVendidosChart"></canvas>
        </div>
    </div>
</div>

<!-- Gráfica de stock por clasificación -->
<div class="col-md-6 mb-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-center fw-bold">Stock de Productos</h5>
            <p class="card-text text-muted text-center">
                Muestra la cantidad de stock disponible de los productos en la clasificación seleccionada.
            </p>
            <canvas id="productosClasificacionChart"></canvas>
        </div>
    </div>
</div>