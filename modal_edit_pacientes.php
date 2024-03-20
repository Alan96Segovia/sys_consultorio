<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Registro</h5>
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
          <div class="row mb-3">
            <div class="col">
              <label for="Editfecha_nac" class="form-label">
                Fecha Nacimiento
              </label>
              <input type="date" class="form-control" name="Editfecha_nac" id="Editfecha_nac">
            </div>
            <div class="col">
              <label for="Editfecha_ing" class="form-label">Fecha Ingreso</label>
              <input type="date" class="form-control" name="Editfecha_ing" id="Editfecha_ing">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="Editcorreo" class="form-label">Paciente Correo</label>
              <input type="email" class="form-control" name="Editcorreo" id="Editcorreo" placeholder="Ingresar Correo Electronico">
            </div>
            <div class="col">
              <label for="Editp_contacto" class="form-label">Paciente Telefono</label>
              <input type="text" class="form-control" name="Editp_contacto" id="Editp_contacto" placeholder="Ingresar Numero de Telefono">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="editt_contacto" class="form-label">Contacto de urgencia</label>
              <input type="text" class="form-control" name="editt_contacto" id="editt_contacto" placeholder="Numero de Telefono del contacto ">
            </div>
            <div class="col">
              <label for="Editconsulta" class="form-label">Motivo Consulta</label>
              <textarea name="consulta" id="Editconsulta" class="form-control" rows="3" placeholder="Escriba aqui.."></textarea>
            </div>

            <div class="col">
              <label for="Editestado" class="form-label">Estado</label>
              <select class="form-control" name="Editestado" id="Editestado" require>
                    <?php 
                    $q_estado = 'select * from estados where estado_id in (5,6)';
                    $execute_estado = pg_query($conexion,$q_estado);
                    while($row_estado = pg_fetch_array($execute_estado)){
                    ?>
                    <option value="<?php echo $row_estado['estado_id'] ?>"><?php echo $row_estado['estado_nombre'] ?></option>
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
