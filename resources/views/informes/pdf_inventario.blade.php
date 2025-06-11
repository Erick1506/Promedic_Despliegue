<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe PDF-Promedic</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2, h3 {
            text-align: center;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .separador {
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <h2>Droguería PROMEDIC CH</h2>
    <h3>Informe de Inventario</h3>
    <p>Periodo: {{ $fecha_inicio }} a {{ $fecha_fin }}</p>

    @if ($filtro === 'producto' && isset($producto))
        <h4>Producto: {{ $producto->Nombre_Producto }}</h4>
        <p><strong>Descripción:</strong> {{ $producto->Descripcion_Producto }}</p>
        <p><strong>Precio:</strong> ${{ number_format($producto->Precio, 2) }}</p>
        <p><strong>Stock:</strong> {{ $producto->Cantidad_Stock }}</p>
        <p><strong>Código de Barras:</strong> {{ $producto->Codigo_Barras }}</p>
        <p><strong>Peso:</strong> {{ $producto->Peso }}</p>
        <p><strong>Categoría:</strong> {{ $producto->categoria->Nombre_Categoria ?? 'N/A' }}</p>
        <p><strong>Clasificación:</strong> {{ $producto->clasificacion->Nombre_Clasificacion ?? 'N/A' }}</p>
        <p><strong>Marca:</strong> {{ $producto->marca->Marca_Producto ?? 'N/A' }}</p>
        <p><strong>Proveedor:</strong> {{ $producto->proveedor->Nombre_Proveedor ?? 'N/A' }}</p>

        <div class="separador"></div>
        <p><strong>Total Entradas:</strong> {{ $entradas }}</p>
        <p><strong>Total Vendido:</strong> {{ $ventas }}</p>

    @elseif ($filtro === 'categoria' && isset($categoria))
        <h4>Categoría: {{ $categoria->Nombre_Categoria }}</h4>
        <p><strong>Descripción:</strong> {{ $categoria->Descripcion_Categoria }}</p>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Entradas</th>
                    <th>Vendidos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $p)
                    <tr>
                        <td>{{ $p->Nombre_Producto }}</td>
                        <td>${{ number_format($p->Precio, 2) }}</td>
                        <td>{{ $p->Cantidad_Stock }}</td>
                        <td>{{ $p->entradas }}</td>
                        <td>{{ $p->ventas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @elseif ($filtro === 'clasificacion' && isset($clasificacion))
        <h4>Clasificación: {{ $clasificacion->Nombre_Clasificacion }}</h4>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Entradas</th>
                    <th>Vendidos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $p)
                    <tr>
                        <td>{{ $p->Nombre_Producto }}</td>
                        <td>${{ number_format($p->Precio, 2) }}</td>
                        <td>{{ $p->Cantidad_Stock }}</td>
                        <td>{{ $p->entradas }}</td>
                        <td>{{ $p->ventas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <p>No se encontraron datos para el filtro seleccionado.</p>
    @endif
</body>
</html>
