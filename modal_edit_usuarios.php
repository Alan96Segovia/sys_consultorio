<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí van los campos de edición (input, select, etc.) -->
        <form id="formEditar" autocomplete="off">
          <!--Mensaje de insercion -->
          <div class="container">
            <div id="contendorMensajesEdit"></div>
          </div>
          <!--Mensaje de insercion -->
          <div class="row mb-3">
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="edit_nombres" class="form-label">
                Nombres
              </label>
              <input type="text" class="form-control" name="edit_nombres" id="edit_nombres" oninput="this.value = this.value.toLowerCase()">
            </div>
            <div class="col">
              <label for="Editapellidos" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="Editapellidos" id="Editapellidos" oninput="this.value = this.value.toLowerCase()">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="edit_usuario" class="form-label">
                Usuario
              </label>
              <input type="text" class="form-control" name="edit_usuario" id="edit_usuario" readonly>
            </div>
            <div class="col">
              <label for="Editpass" class="form-label">pass</label>
              <input type="text" class="form-control" name="Editpass" id="Editpass">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="edit_estado" class="form-label">Estado</label>

              <select class="custom-select" id="edit_estado" name="edit_estado">
                <option value="">Elegir Estado</option>
                <?php
                /**la variable executeq_estado traigo del archivo usuarios.php */
                while ($fila = pg_fetch_array($executeq_estado)) {
                ?>
                  <option value="<?php echo $fila['estado_id'] ?>"><?php echo $fila['estado_nombre'] ?></option>
                <?php } ?>

              </select>
            </div>
            <div class="col">
              <label for="Editgrupo" class="form-label">Grupo</label>

              <select class="custom-select" id="Editgrupo" name="Editgrupo">
                <option value="">Elegir Grupo</option>
                <?php
                /**la variable executeq_estado traigo del archivo usuarios.php */
                while ($Efila_grupo = pg_fetch_array($execute_Egrupo)) {
                ?>
                  <option value="<?php echo $Efila_grupo['grupo_id'] ?>"><?php echo $Efila_grupo['grupo_nombre'] ?></option>
                <?php } ?>

              </select>
            </div>
          </div>

          <!-- Agrega un campo oculto para almacenar el ID del paciente -->
          <input type="hidden" id="editPacienteId" name="editPacienteId">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="btnGuardarEdicion">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>