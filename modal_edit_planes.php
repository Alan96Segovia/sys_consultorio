<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Registro del Plan</h5>
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
              <label for="Editplan_nombre" class="form-label">
                Nombre del Plan
              </label>
              <input type="text" class="form-control" id="Editplan_nombre" placeholder="Escribir nombre del plan" require>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="editprecio_plan" class="form-label">
                Precio del Plan
              </label>
              <input type="number" min='0' class="form-control" name="editprecio_plan" id="editprecio_plan" placeholder="Editar Monto del Plan" require>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="EditEstado" class="form-label">
                Estado del Plan
              </label>
              <select class="form-control" name="EditEstado" id="EditEstado">
                <option value="">Cambiar Estado</option>
                <?php 
                    $q_estado = 'select * from estados where estado_id in (5,6)';
                    $execute_estado = pg_query($conexion,$q_estado);
                    while($row_estado = pg_fetch_array($execute_estado)){
                    ?>
                    <option value="<?php echo $row_estado['estado_id'] ?>"><?php echo $row_estado['estado_nombre'] ?></option>
                    <?php } ?>
              </select>
              <!-- Agrega un campo oculto para almacenar el ID del plan -->
                <input type="hidden" id="editPlanId" name="editPlanId">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="btnGuardarEdicion">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
