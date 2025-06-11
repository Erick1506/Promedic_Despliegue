document.addEventListener('DOMContentLoaded', function () {
    // Función para leer y parsear JSON de inputs ocultos
    function safeParseJSON(id) {
        const elem = document.getElementById(id);
        if (!elem || !elem.value) return [];
        try {
            return JSON.parse(elem.value);
        } catch (e) {
            console.error(`Error parsing JSON from #${id}:`, e);
            return [];
        }
    }

    // 1. Ventas semanales
    const labels = safeParseJSON('ventasLabels');
    const data = safeParseJSON('ventasData');
    const ctx = document.getElementById('ventasChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ventas semanales',
                data: data,
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderWidth: 2,
                pointRadius: 5,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // 2. Productos más vendidos (Top 5)
    const ctx2 = document.getElementById('productosVendidosChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: safeParseJSON('productosVendidosLabels'),
            datasets: [{
                label: 'Cantidad Vendida',
                data: safeParseJSON('productosVendidosData'),
                backgroundColor: '#4CAF50'
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: { beginAtZero: true }
            }
        }
    });

    // 3. Productos menos vendidos (Bottom 5)
    const ctx3 = document.getElementById('productosMenosVendidosChart').getContext('2d');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: safeParseJSON('productosMenosVendidosLabels'),
            datasets: [{
                label: 'Cantidad Vendida',
                data: safeParseJSON('productosMenosVendidosData'),
                backgroundColor: '#FF5733'
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: { beginAtZero: true }
            }
        }
    });

    // 4. Stock de productos por clasificación
    const ctx4 = document.getElementById('productosClasificacionChart').getContext('2d');
    new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: safeParseJSON('productosClasificacionLabels'),
            datasets: [{
                label: 'Stock',
                data: safeParseJSON('productosClasificacionData'),
                backgroundColor: '#36A2EB'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
