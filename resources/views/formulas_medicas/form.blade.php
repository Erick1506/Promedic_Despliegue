
    <div class="main-content">
        <div class="outer-container">
            <div class="inner-container">
                <h2>Agregar Fórmula Médica</h2>

                <div class="mb-3">
                    <label for="Nombre_Paciente" class="form-label">Nombre del Paciente</label>
                    <input type="text" name="Nombre_Paciente" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Identificacion_Paciente" class="form-label">Identificación del Paciente</label>
                    <input type="number" name="Identificacion_Paciente" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="Fecha_Insercion" class="form-label">Fecha de Inserción</label>
                    <input type="date" name="Fecha_Insercion" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Subir Imagen</label>
                    <input type="file" name="imagen" class="form-control" id="imagen" accept="image/*" required>
                </div>

                <input type="hidden" name="Id_Administrador" value="1">

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-light">Guardar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</form>
