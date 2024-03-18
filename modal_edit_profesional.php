<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Profesional</h5>
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
            <div class="col">
              <label for="Editcedula" class="form-label">
                Nro. Cedula
              </label>
              <input type="text" class="form-control" id="Editcedula" placeholder="Ingresar Nro de Cedula">
              <small>Escribir numero sin puntos</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="edit_nombres" class="form-label">
                Nombres
              </label>
              <input type="text" class="form-control" name="edit_nombres" id="edit_nombres" placeholder="Escribir nombre del paciente">
            </div>
            <div class="col">
              <label for="Editapellidos" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="Editapellidos" id="Editapellidos" placeholder="Escribir Apellido del paciente">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="Editcolor" class="form-label">Color</label>
              <input type="color" class="form-control" name="Editcolor" id="Editcolor">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="estado" class="form-label">
                Estado
              </label>
              <select class="form-control" name="estado" id="estado">
                <option value="">Seleccionar Estado</option>
                <?php
                /**Realizo el query para mostrar el estado del plan */
                $q_estados = "SELECT * FROM estados WHERE estado_id in(5,6) ORDER BY estado_id  ";

                $execute_estado = pg_query($conexion, $q_estados);
                while ($fila_estado = pg_fetch_array($execute_estado)) { ?>
                  <option value="<?php echo $fila_estado['estado_id']; ?>"><?php echo $fila_estado['estado_nombre']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <!-- Agrega un campo oculto para almacenar el ID del paciente -->
          <input type="hidden" id="editProfesionalId" name="editProfesionalId">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="btnGuardarEdicion">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>