<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Agregar Usuario</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formulario_usuarios" autocomplete="off">
          <!--Mensaje de insercion -->
          <div class="container">
            <div id="contendorMensajes"></div>
          </div>
          <!--Mensaje de insercion -->
          <div class="row mb-3">
            <div class="col">
              <label for="nombres" class="form-label">
                Nombres
              </label>
              <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Escribir nombre del paciente" oninput="this.value = this.value.toUpperCase()">
            </div>
            <div class="col">
              <label for="apellidos" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Escribir Apellido del paciente" oninput="this.value = this.value.toUpperCase()">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="usuario" class="form-label">
                Usuario
              </label>
              <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Escribir nombre del usuario" oninput="this.value = this.value.toLowerCase()">
            </div>
            <div class="col">
              <label for="pass" class="form-label">Contraseña</label>
              <input type="text" class="form-control" name="pass" id="pass" placeholder="Escribie tu nueva contraseña">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="grupo" class="form-label">Grupo</label>

              <select class="custom-select" id="grupo" name="grupo">
                <option value="">Elegir Grupo</option>
                <?php
                /**la variable executeq_estado traigo del archivo usuarios.php */
                while ($fila_grupo = pg_fetch_array($execute_grupo)) {
                ?>
                  <option value="<?php echo $fila_grupo['grupo_id'] ?>"><?php echo $fila_grupo['grupo_nombre'] ?></option>
                <?php } ?>

              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-primary" value="Agregar" id="btnRegistrar">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>