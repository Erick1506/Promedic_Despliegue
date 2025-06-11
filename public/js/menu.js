function pluralize(tipo) {
  if (tipo === 'clasificacion') return 'clasificaciones';
  if (tipo === 'categoria') return 'categorias';
  return tipo + 's'; // fallback si agregas otros tipos
}

function toggleDescription(button) {
  const desc = button.closest('.category-card, .classification-card').querySelector('.descripcion');
  if (!desc) return;
  desc.style.display = (desc.style.display === 'none' || desc.style.display === '') ? 'block' : 'none';
}

function startEdit(button, tipo, id) {
  const descDiv = button.closest('.descripcion');
  if (!descDiv) return;

  const p = descDiv.querySelector('.desc-text');
  const originalText = p.textContent;
  p.style.display = 'none';

  // Crear textarea si no existe
  let textarea = descDiv.querySelector('textarea');
  if (!textarea) {
    textarea = document.createElement('textarea');
    textarea.classList.add('form-control', 'mb-2');
    textarea.value = originalText;
    descDiv.insertBefore(textarea, button.parentNode);
  } else {
    textarea.value = originalText;
    textarea.style.display = 'block';
  }

  // Cambiar botón para guardar
  button.textContent = 'Guardar';
  button.setAttribute('data-id', id);
  button.setAttribute('data-tipo', tipo);
  button.onclick = () => saveEdit(button);
}

function saveEdit(button) {
  const tipo = button.getAttribute('data-tipo');
  const id = button.getAttribute('data-id');
  console.log('saveEdit llamado con:', { tipo, id });

  const descDiv = button.closest('.descripcion');
  const textarea = descDiv.querySelector('textarea');
  const newText = textarea.value.trim();

  if (!tipo || !id) {
    alert('Faltan datos para actualizar');
    return;
  }

  // Crear el cuerpo de la solicitud basado en el tipo
  let bodyData;
  if (tipo === 'clasificacion') {
    bodyData = { 
      Descripcion_Clasificacion: newText // Cambia esto para actualizar la descripción de la clasificación
    };
  } else if (tipo === 'categoria') {
    bodyData = { 
      Descripcion_Categoria: newText // Cambia esto para actualizar la descripción de la categoría
    };
  }

  fetch(`/api/${pluralize(tipo)}/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(bodyData)
  })
    .then(response => {
      if (!response.ok) throw new Error('Error en la actualización');
      return response.json();
    })
    .then(data => {
      const p = descDiv.querySelector('.desc-text');
      p.textContent = newText;
      p.style.display = 'block';
      textarea.style.display = 'none';

      button.textContent = 'Editar';
      button.onclick = () => startEdit(button, tipo, id);

      showToast(`La ${tipo} se ha actualizado correctamente.`);
    })
    .catch(error => {
      alert('Error al actualizar: ' + error.message);
    });
}

function showToast(message) {
  const toast = document.getElementById('toast-message');
  toast.querySelector('.toast-body').textContent = message;
  toast.style.display = 'block';

  setTimeout(() => {
    toast.style.display = 'none';
  }, 3000);
}

function hideToast() {
  const toast = document.getElementById('toast-message');
  toast.style.display = 'none';
}

// BUSCAR CATEGORIAS Y CLASIFICACIONES 
  document.getElementById('search-bar').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const categoryCards = document.querySelectorAll('.category-card');
    
    categoryCards.forEach(card => {
      const categoryName = card.querySelector('h6 span').textContent.toLowerCase();
      const classificationCards = card.querySelectorAll('.classification-card');
      let hasVisibleClassifications = false;

      // Filtrar por nombre de categoría
      if (categoryName.includes(searchTerm)) {
        card.style.display = ''; // Mostrar la categoría
      } else {
        card.style.display = 'none'; // Ocultar la categoría
      }

      // Filtrar clasificaciones dentro de la categoría
      classificationCards.forEach(classification => {
        const classificationName = classification.querySelector('strong').textContent.toLowerCase();
        if (classificationName.includes(searchTerm)) {
          classification.style.display = ''; // Mostrar clasificación
          hasVisibleClassifications = true;
        } else {
          classification.style.display = 'none'; // Ocultar clasificación
        }
      });

      // Si no hay clasificaciones visibles, ocultar la categoría
      if (!hasVisibleClassifications && card.style.display !== 'none') {
        card.style.display = 'none';
      }
    });
  });


