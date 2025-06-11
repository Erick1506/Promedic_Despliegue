document.getElementById('tipo_informe').addEventListener('change', function () {
    const tipo = this.value;
    document.getElementById('categoria_div').classList.toggle('d-none', tipo === "");
    document.getElementById('clasificacion_div').classList.toggle('d-none', tipo !== "clasificacion" && tipo !== "producto");
    document.getElementById('producto_div').classList.toggle('d-none', tipo !== "producto");
});

document.getElementById('categoria_id').addEventListener('change', function () {
    const idCategoria = this.value;
    fetch(`/clasificaciones/${idCategoria}`)
        .then(res => res.json())
        .then(data => {
            const clasSelect = document.getElementById('clasificacion_id');
            clasSelect.innerHTML = '<option value="">Seleccione clasificación</option>';
            data.forEach(clas => {
                clasSelect.innerHTML += `<option value="${clas.Id_Clasificacion}">${clas.Nombre_Clasificacion}</option>`;
            });
        });
});

document.getElementById('clasificacion_id').addEventListener('change', function () {
    const idClasificacion = this.value;
    fetch(`/productos/${idClasificacion}`)
        .then(res => res.json())
        .then(data => {
            const prodSelect = document.getElementById('producto_id');
            prodSelect.innerHTML = '<option value="">Seleccione producto</option>';
            data.forEach(prod => {
                prodSelect.innerHTML += `<option value="${prod.Id_Producto}">${prod.Nombre_Producto}</option>`;
            });
        });
});
