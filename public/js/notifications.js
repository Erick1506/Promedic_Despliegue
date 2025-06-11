document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('notificationsModal');
  const notificationCount = document.getElementById('notificationCount');
  const notificationsContent = document.getElementById('notificationsContent');

  // Utilidad para obtener datos de la API
  async function fetchData(url) {
    const response = await fetch(url);
    if (!response.ok) throw new Error(`Error al obtener datos desde ${url}`);
    return await response.json();
  }

  // Función para cargar todas las notificaciones
  async function cargarNotificaciones() {
    try {
      const [productosCriticos, notificaciones, mensajes] = await Promise.all([
        fetchData('api/productos-criticos'),         
        fetchData('api/notificaciones'),
        fetchData('api/mensajes-regente')
      ]);

      // Calcular cantidad total
      const totalNotificaciones = productosCriticos.length + notificaciones.length + mensajes.length;
      if (totalNotificaciones > 0) {
        notificationCount.style.display = 'inline-block';
        notificationCount.textContent = totalNotificaciones;
      } else {
        notificationCount.style.display = 'none';
      }

      // Construir HTML
      let html = '';

      // Productos críticos
      if (productosCriticos.length > 0) {
        html += '<h6>Productos críticos:</h6><ul>';
        productosCriticos.forEach(p => {
          let estado = 'Normal';
          const hoy = new Date();
          const vencimiento = new Date(p.Fecha_Vencimiento);

          if (vencimiento < hoy) {
            estado = 'Vencido';
          } else if (vencimiento <= new Date(hoy.getTime() + 7 * 24 * 60 * 60 * 1000)) {
            estado = 'Por vencer pronto';
          }

          if (p.Cantidad_Stock > p.Cantidad_Maxima) {
            estado = 'Stock máximo superado';
          } else if (p.Cantidad_Stock <= p.Cantidad_Minima) {
            estado = 'Stock mínimo alcanzado';
          }

          html += `<li><strong>${p.Nombre_Producto}</strong>: ${estado} (Stock: ${p.Cantidad_Stock}) - Vence: ${p.Fecha_Vencimiento}</li>`;
        });
        html += '</ul>';
      } else {
        html += '<p>No hay productos críticos.</p>';
      }

      // Notificaciones
      if (notificaciones.length > 0) {
        html += '<h6>Notificaciones:</h6><ul>';
        notificaciones.forEach(n => {
          const fecha = new Date(n.fecha_creacion || n.fecha || n.created_at);
          html += `<li>${n.mensaje} <small class="text-muted">(${fecha.toLocaleString()})</small></li>`;
        });
        html += '</ul>';
      } else {
        html += '<p>No hay notificaciones nuevas.</p>';
      }

      // Mensajes a regente
      if (mensajes.length > 0) {
        html += '<h6>Mensajes a Regente:</h6><ul>';
        mensajes.forEach(m => {
          const fecha = new Date(m.fecha || m.created_at);
          html += `<li>${m.mensaje} <small class="text-muted">(${fecha.toLocaleString()})</small></li>`;
        });
        html += '</ul>';
      }

      notificationsContent.innerHTML = html;

    } catch (error) {
      notificationsContent.innerHTML = `<p class="text-danger">Error al cargar notificaciones.</p>`;
      console.error('Error al cargar datos:', error);
    }
  }

  // Mostrar modal → cargar notificaciones
  if (modal) {
    modal.addEventListener('show.bs.modal', cargarNotificaciones);
  }

  // Mostrar conteo al cargar página
  cargarNotificaciones();
});
